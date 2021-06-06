<?php
    $rows="";
    $temp="";
    $count=0;
    $page = 6;
    session_start();
    if(isset($_GET['index']))
        $index = intval($_GET['index']);
    else
        $index = 0;
    if(isset($_GET['type'])&&$_GET['type']=="修改個人資料")
        header("location:modify_single.php");    
    if(isset($_POST['key_2']))
        $_SESSION['key_2'] = $_POST['key_2'];

    include "link.php";

    if(isset($_GET['remove_id'])&&isset($_GET['seq']))
    {
        //修改庫存
        $sql = "select quantity from order_form where 
                members_id = '".$_SESSION['user_id']."' and 
                order_count = '".$_GET['seq']."' and 
                commodity_id = '".$_GET['remove_id']."'";
        if ($result = mysqli_query($link, $sql)) {
            $row = mysqli_fetch_assoc($result);
            $new_quan=$row["quantity"];
            mysqli_free_result($result); // 釋放佔用的記憶體
        }
        // $sql = "update commodity set stock = stock + ".$new_quan." where commodity.pid = '".$_GET['remove_id']."'";
        // mysqli_query($link, $sql);

        $sql = "update order_form set apply_for_return = 1 where commodity_id = '".$_GET['remove_id']."' and 
                members_id = '".$_SESSION['user_id']."' and
                order_count = '".$_GET['seq']."'";
        mysqli_query($link, $sql);
        header("location: orderlist.php"); 
    }   

    $cause_error = false;
    $msg = "";
    $contents = array();
    if(isset($_SESSION['key_2']))
    {
        $key = $_SESSION['key_2'];
        if(trim($key)!="")
        {
            $sql = "select order_form.order_count, order_form.quantity, order_form.time, order_form.apply_for_return, commodity.name, commodity.price, commodity.pid
            from order_form
            left join commodity
            on order_form.commodity_id = commodity.pid
            where order_form.members_id = '".$_SESSION['user_id']."'
            order by order_form.order_count desc, order_form.commodity_id asc";           
            // $sql = "select * from commodity where name like '%$key%' or summary like '%$key%'";
            if($result = mysqli_query($link,$sql))
            {
                $i=0;
                while($row = mysqli_fetch_assoc($result))
                {
                    $num = $row['order_count'];
                    $t = $_SESSION['user_id'];
                    $bit = 15;//產生7位數的數字編號
                    $num_len = strlen($num)+strlen($t);
                    $zero ="";
                    for($j=$num_len; $j<$bit; $j++ ){
                        $zero .="0";
                    }
                    $real_num = $t.$zero.$num;
                    if($i>=$index*10&&$i<$index*10+10&&$row['time']!=0&&$real_num==$key)//防止訂單還未送出就顯示在會員專區
                    {
                        
                        $rows.="<tr><td>".$real_num."</td>
                                <td>".$row['time']."</td>
                                <td>".$row['name']."</td>           
                                <td>".$row['quantity']."</td>
                                <td>".$row['price']."</td>
                                <td class='text-right'>
                                <button class='btn btn-sm btn-danger' onClick='" . ($row['apply_for_return'] == 1?"": "
                                arealist_remove(".$row['pid'].",".$row['order_count'].")"). "'> " . 
                                ($row['apply_for_return']==1?"申請退貨中":"申請退貨") . "</button>
                                </td>
                                </tr>";
                        $count++;
                    }
                    $i++;
                }
                // if($rows=="")
                //     $i=0; 
                mysqli_free_result($result);
            }
        }
        else
        {
            $cause_error = true;
            $msg = "您並未輸入任何字，請輸入字後再搜尋一遍!";
        }
    }
    // else header("location : members_area.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>會員專區</title>
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/shop-homepage.css" rel="stylesheet">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="css/font_awesome.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/in_cart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
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
            <?php include "left_side_members.php"; ?>

            <div class="col-lg-10 ">
                <div style="margin-top:5px"></div>
                <div class="row">
                    <div class="col-md-8 " style="color:#D68B00;text-align:right;line-height:40px;">
                        <?php
                            if($cause_error)
                                echo "$msg";
                            else if($rows=="")
                                echo "找不到結果";
                        ?>
                    </div>
                    <div class="col-md-4 ">
                        <form class="form-inline" name="form_search" id="form_search" action="orderlist.php"
                            method="POST">
                            <div class="input-group">
                                <input class="form-control" aria-label="Search" type="text" id="key_2" name="key_2"
                                    placeholder="請輸入訂單編號"
                                    <?php if(isset($_POST['key_2'])) echo 'value="'.$_POST['key_2'].'"';?>>
                                    <button class="btn text-white" type="submit"style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
 background-blend-mode: multiply,multiply;">訂單搜尋</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div style="margin-top:5px"></div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">訂單編號 </th>
                                <th scope="col">建立時間</th>
                                <th scope="col">品名</th>
                                <th scope="col">數量</th>
                                <th scope="col">單價</th>
                                <th scope="col" class="text-right">取消訂單</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo $rows;?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <?php
                        if($index != 0) echo '<a href="?index='.($index-1).'"><button class="btn btn-primary">
                        上一頁
                    </button></a>';
                        if(($index+1)*10 <= $count) echo '&emsp;<a href="?index='.($index+1).'"><button class="btn btn-primary">
                        下一頁
                    </button></a>';
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