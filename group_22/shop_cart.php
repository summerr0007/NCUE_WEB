<?php
$page = 4;
$rows="";
$row="";
$now_bill="";
$sum = 0;
session_start();

//未登入跳至登入畫面
if(!isset($_SESSION['user_id']))
    header("location: login.php");

// 送出編碼的MySQL指令
include "link.php";
//撈出當前是哪個訂單
$sql = "select bill from members where account = '".$_SESSION['user_id']."'";
if ($result = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        $now_bill = $row["bill"];
    }
    mysqli_free_result($result); // 釋放佔用的記憶體   
}

// 若增加商品(收到add_num)
if(isset($_GET['add_id'])&&isset($_GET['add_num'])&&isset($_GET['add_type']))
{
    $sql = "select quantity,stock from order_form,members,commodity where 
            order_form.members_id = '".$_SESSION['user_id']."' and 
            order_form.commodity_id = '".$_GET['add_id']."'and
            order_form.order_count = '".$now_bill."'and
            commodity.pid = '".$_GET['add_id']."'";           
    if ($result = mysqli_query($link, $sql)) {
        $row = mysqli_fetch_assoc($result);
        if($row!=null&&(intval($_GET['add_num'])<=intval($row['stock'])||$_GET['add_type']!=3))
        {
            $rows = $row["quantity"];//此處rows變數拿來抓數量
            $new_quan=intval($_GET['add_num'])+intval($rows);
            
            $sql = "update order_form set quantity = '".$new_quan."' where 
                    order_form.members_id = '".$_SESSION['user_id']."' and 
                    order_form.order_count = '".$now_bill."' and 
                    order_form.commodity_id = '".$_GET['add_id']."'";
            mysqli_query($link, $sql);
            mysqli_free_result($result); // 釋放佔用的記憶體
            //修改庫存
            $sql = "update commodity set stock = stock - ".$_GET['add_num']." where commodity.pid = '".$_GET['add_id']."'";
            mysqli_query($link, $sql);             
        }
        else if($row!=null&&intval($_GET['add_num'])>intval($row['stock'])&&$_GET['add_type']==3)//種類三為在購物車內的加法
        {
            header("location: shop_cart.php");
        }
        else{
            $sql = "insert into order_form(commodity_id,members_id,order_count,	quantity) 
                    values ('".$_GET['add_id']."','".$_SESSION['user_id']."',$now_bill,".$_GET['add_num'].")";
            $result = mysqli_query($link, $sql);
            //修改庫存
            $sql = "update commodity set stock = stock - ".$_GET['add_num']." where commodity.pid = '".$_GET['add_id']."'";
            mysqli_query($link, $sql);            
        }


    }
    if($_GET['add_type']==0)
        echo "<script>history.back(-1)</script>";
    else
        header("location: shop_cart.php");

}
// if(isset($_GET['remove_id']))
// {
//     //修改庫存
//     $sql = "select quantity from order_form where 
//             members_id = '".$_SESSION['user_id']."' and 
//             order_count = '".$now_bill."' and 
//             commodity_id = '".$_GET['remove_id']."'";
//     if ($result = mysqli_query($link, $sql)) {
//         $row = mysqli_fetch_assoc($result);
//         $new_quan=$row["quantity"];
//         mysqli_free_result($result); // 釋放佔用的記憶體
//     }
//     $sql = "update commodity set stock = stock + ".$new_quan." where commodity.pid = '".$_GET['remove_id']."'";
//     mysqli_query($link, $sql);

//     $sql = "delete from order_form where commodity_id = '".$_GET['remove_id']."' and 
//             members_id = '".$_SESSION['user_id']."' and
//             order_count = '".$now_bill."'";
//     mysqli_query($link, $sql);
//     header("location: shop_cart.php"); 
// }


//撈出當前訂單的所有商品項目
$sql = "select file_name, name, price, quantity, pid, apply_for_return from order_form, commodity where 
        order_count = '".$now_bill."' and order_form.commodity_id = commodity.pid
        and members_id = '".$_SESSION['user_id']."'";
if($result = mysqli_query($link,$sql))
{
    $disable=true;
    $sum = 0;
    $rows = "";
    while($row = mysqli_fetch_assoc($result))
    {
        // $rows.="<tr><td><img src='images/".$row['file_name']."' height='100' alt='no img'/></td>
        //         <td>".$row['name']."</td>
        //         <td class='text-right'>$".$row['price']."</td>
        //         <td class='text-right'>".$row['quantity']."</td>
        //         <td class='text-right'><button class='btn btn-sm btn-danger' onClick='is_remove(".$row['pid'].")'>X</button></td>
        //         </tr>";
        if($row['apply_for_return']==0)
        {
            $check="checked";
            $disable=false;
        }
        else
            $check="";
            
        $rows.="<tr>
                <td><div class='form-group form-check'><input type='checkbox' class='form-check-input' id='".$row['pid']."'".$check." onChange='is_check(".$row['pid'].")' ></div></td>
                <td><a href='item.php?item_id=".$row['pid']."'><img src='images/".$row['file_name']."'  style='height:80px;' alt='no img'/></a></td>
                <td><a href='item.php?item_id=".$row['pid']."'>".$row['name']."</a></td>
                <td class='text-right'>$".$row['price']."</td>
                <td>
                    <div class='input-group col-lg-6 offset-lg-6'>
                        <button class='btn btn-outline-secondary' type='button' onclick='is_change(".$row['pid'].",-1,".$row['quantity'].")'>-</button>
                        <input type='text' class='form-control' value=".$row['quantity']." id='num' style='text-align:center'  onChange=".'"'."is_change(".$row['pid'].",document.getElementById('num').value-".$row['quantity'].",".$row['quantity'].")".'"'.">
                        <button class='btn btn-outline-secondary' type='button' onclick='is_change(".$row['pid'].",1,".$row['quantity'].")'>+</button>
                    </div>
                </td>
                <td class='text-right'><button class='btn btn-sm btn-danger' onClick='is_remove(".$row['pid'].")'>X</button></td>
                </tr>"; 
        if($row['apply_for_return']==0)            
        $sum += $row['price'] * $row['quantity'];
    }
    mysqli_free_result($result);
}

mysqli_close($link); // 關閉資料庫連結

$today = date('Ymd');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>購物車</title>
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <!-- <link href="css/shop-homepage.css" rel="stylesheet"> -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <!-- <link href="css/font_awesome.min.css" rel="stylesheet"> -->
    <link href="css/style.css" rel="stylesheet">
    <script src="js/in_cart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* img { height: 100px; background-color: white;} */
    </style>
    <script> 
        // var top1 = 0;
        // $(document).ready(function(){
        //     const $ScrollWrap = $("#scroll-wrap")
        //     // 监听滚动停止
        //     let t1 = 0;
        //     let t2 = 0;
        //     let timer = null; // 定時器
        //     $(window).on("touchstart", function(){
        //         // 觸控開始
        //     })
        //     $(window).on("scroll", function(){
        //         // 滾動
        //         clearTimeout(timer)
        //         timer = setTimeout(isScrollEnd, 100)
        //         t1 = $(this).scrollTop()
        //     })
        //     function isScrollEnd() {
        //         t2 = $(window).scrollTop();
        //         if(t2 == t1){
        //             if(t2>top1)
        //             {
        //                 top1=t2;
        //                 $("nav").slideUp();
        //             }
        //             else if(t2<top1)
        //             {
        //                 top1=t2;
        //                 $("nav").slideDown();
        //             }
        //             clearTimeout(timer)
        //         }
        //     }
        // })
        $(document).ready(function(){

            var p=0,

                t=0,

                n=$("nav");

            $(window).scroll(function(){

                p=$(this).scrollTop();

                if(t<p&&n.is(':visible')){
                    n.stop().fadeOut(25);
                    //下滾
                }
                else if(t>p&&!n.is(':visible')){
                    n.stop().show();
                        //上滾            
                }
                t = p ;
                // setTimeout(function(){ t = p ; },0)
            })

        })
    </script>    
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container mb-4">
        <div class="row">
            <div class="col-12">
            <div id="intro">
                <div class="table-responsive">
                    <?php
                        if($rows=="")
                            echo "
                            <div style = 'margin-top:100px'></div>
                            <p Align=center><img src='images/shop_cart_none.jpg' style='height:200px;' alt='no img'></p>
                                <h2 style='color:#D68B00;text-align:center;'>購物車內空空如也!!</h2>
                                ";
                        else
                        {
                            echo'
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">勾選</th>
                                    <th scope="col">商品圖片</th>
                                    <th scope="col">品名</th>
                                    <th scope="col" class="text-right">價格</th>
                                    <th scope="col" class="text-right">數量&emsp;</th>
                                    <th scope="col" class="text-right">移除此商品</th>
                                </tr>
                            </thead>
                            <tbody>';
                                echo    $rows;
                                echo'
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>加總</td>
                                    <td class="text-right">$';
                                         echo $sum; 
                                         echo'
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>運費</td>
                                    <td class="text-right">$
                                        60
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>總價錢</strong></td>
                                    <td class="text-right"><strong>$';
                                             echo $sum + 60; echo'</strong></td>
                                </tr>
                            </tbody>
                        </table>';
                        }                        
                    ?>
                
                </div>
            
            <?php
                if($rows!="")
                {
                    echo'
                    <div class="col mb-2">
                        <div class="row">
                            <div class="col-sm-12  col-md-6">
                                <button class="btn btn-block btn-light" onClick="redir(';echo"'";echo"index','',";echo '0)">繼續購物</button>
                            </div>
                            <div class="col-sm-12 col-md-6 text-right">
                                <button class="btn btn-lg btn-block btn-success text-uppercase"';if($disable)echo'disabled="disabled"'; echo'onClick="checkout('; echo $today; echo','; echo $now_bill; echo ')">送出訂單</button>
                            </div>
                        </div>
                    </div>
                    ';
                }
            ?>
        </div>    
        </div>    
        </div>
    </div>
    <!-- Footer -->
    <?php include "footer.php"; ?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>