<?php
    $rows="";
    $temp="";
    $page = 6;
    $count=0;
    session_start();
    if(isset($_GET['index']))
        $index = intval($_GET['index']);
    else
        $index = 0;
    //未登入跳至登入畫面
    if(!isset($_SESSION['user_id']))
        header("location: login.php");
    if(isset($_GET['type'])&&$_GET['type']=="修改個人資料")
    {
        if(isset($_POST['password']) && isset($_POST['email'])&&isset($_POST['password2']))
        {
            if(strlen($_POST['password'])>=8&&strlen($_POST['password'])<=12&&$_POST['password2']==$_POST['password']&&preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['email']))
            {
                include "link.php";//連到資料庫
                $sql = "update members set email = '".$_POST['email']."',password = '".$_POST['password']."' where account = '".$_SESSION['user_id']."'";
                mysqli_query($link,$sql);
                mysqli_close($link); // 關閉資料庫連結 
                // echo '
                // <script>alert("修改成功");window.location.assign("members_area.php"); 
                // </script>';
                echo '
                <script>window.location.assign("members_area.php?a=1"); 
                </script>';                                                                    
            }
            
        }
     
    }
    // 送出編碼的MySQL指令
    include "link.php";
    if(isset($_GET['bill'])&&isset($_GET['time']))
    {
        
        $sql = "update order_form set time = '".$_GET['time']."'where 
                order_form.members_id = '".$_SESSION['user_id']."' and 
                order_form.order_count = '".$_GET['bill']."' and
                order_form.apply_for_return = 0";
        mysqli_query($link, $sql);

        $sql = "update order_form set order_count = ".$_GET['bill']."+1 where 
                order_form.members_id = '".$_SESSION['user_id']."' and 
                order_form.order_count = '".$_GET['bill']."' and
                order_form.apply_for_return = 1";
        mysqli_query($link, $sql);

        $sql = "update members set bill = bill + 1 where 
                members.account = '".$_SESSION['user_id']."' and
                members.bill = '".$_GET['bill']."'";
        mysqli_query($link, $sql);
        
        header("location: members_area.php");
    }

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
        header("location: members_area.php"); 
    }

    $sql = "select order_form.order_count, order_form.quantity, order_form.time, order_form.apply_for_return, order_form.comment, commodity.name, commodity.price, commodity.pid
            from order_form
            left join commodity
            on order_form.commodity_id = commodity.pid
            where order_form.members_id = '".$_SESSION['user_id']."'
            order by order_form.order_count desc, order_form.commodity_id asc";
    if($result = mysqli_query($link,$sql))
    {
        $i=0;
        while($row = mysqli_fetch_assoc($result))
        {
            if($i>=$index*10&&$i<$index*10+10&&$row['time']!=0)//防止訂單還未送出就顯示在會員專區
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
                $rows.="<tr><td>".$real_num."</td>
                        <td>".$row['time']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['quantity']."</td>
                        <td>".$row['price']."</td>
                        <td class='text-right'>
                        <div id='".$real_num.$row['pid']."'><button class='btn btn-sm ".($row['comment']==1?'btn-secondary':'btn-info')."' data-toggle='modal' data-target='#exampleModal' ".($row['comment']==1?"disabled":"onclick='change_text(".'"'.$real_num.'"'.",".'"'.$row['name'].'"'.",".$row['pid'].",".$row['order_count'].")'").">".($row['comment']==1?"完成":"給評")."</button></div>
                        </td>                        
                        <td class='text-right'>
                        <button class='btn btn-sm btn-danger' " . ($row['apply_for_return'] == 1?"disabled": 
                        "onClick='area_remove(".$row['pid'].",".$row['order_count'].")'"). "> " . 
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
    mysqli_close($link); // 關閉資料庫連結
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員專區</title>
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <!-- Bootstrap core CSS -->
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Custom styles for this template -->
    <!-- <link href="css/shop-homepage.css" rel="stylesheet"> -->
    <!-- <script src="vendor/bootstrap/js/bootstrap.min.js"></script> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
    <!------ Include the above in your HEAD tag ---------->
    <!-- <link href="css/font_awesome.min.css" rel="stylesheet"> -->
    <link href="css/style.css" rel="stylesheet">
    <script src="js/in_cart.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <script>
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

<body <?php if(isset($_GET['a'])){ echo'onload="Swal.fire({';
		echo"	icon: 'success',";
		echo"	title: '修改成功!',";
		echo'	showConfirmButton: false,
				timer: 800
			}).then(() => {';
		echo"			window.location.href = 'members_area.php';";
		echo'		    })"';} ?>>
    
        
    <?php include "header.php"; ?>
    <div class="container mb-4">
        <div class="row">
            <?php include "left_side_members.php"; ?>

            <div class="col-lg-10 ">
            <?php if(isset($_GET['type'])&&$_GET['type']=="修改個人資料") {echo'
                <div style="margin-top:50px"></div>
                <form class="form-horizontal" role="form" id="form_mod" name="form_mod" action="" method="POST">
                    <div class="form-group row">
                        <label class="col-lg-3 control-label">密碼重設</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="限8-12個字"';
                            if(isset($_POST['password'])) echo'value="'.$_POST['password'].'"'; 
                            echo'>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" ></label>
                        <div class="col-lg-8"  style="color:red;font-weight:bold;" >';
                        if(!isset($_POST['password'])) echo'密碼重設這行為必填的欄位';
                        else if(strlen($_POST['password'])<8) echo'密碼長度必須不小於8';
                        else if(strlen($_POST['password'])>12) echo'密碼長度必須不大於12';echo'</div>
                    </div>                         
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" >密碼確認</label>
                        <div class="col-lg-8">
                            <input type="password" class="form-control" id="password2" name="password2" placeholder="重新輸入密碼">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" ></label>
                        <div class="col-lg-8"  style="color:red;font-weight:bold;" >'; 
                        if(!isset($_POST['password2'])||strlen($_POST['password2'])==0) echo'密碼確認這行為必填的欄位';
                        else if(!isset($_POST['password'])||$_POST['password2']!=$_POST['password']) echo'兩次密碼並不相同，請重新輸入!';echo'</div>
                    </div>                    
                    <div class="form-group row">
                        <label class="col-lg-3 control-label">E-mail</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" id="email" name="email" placeholder="格式如:MyEmail@gmail.com"';
                        if(isset($_POST['email'])) echo'value="'.$_POST['email'].'"';         
                       echo '> </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" ></label>
                        <div class="col-lg-8"  style="color:red;font-weight:bold;" >';
                        if(!isset($_POST['email'])) echo'E-mail這行為必填的欄位';
                        else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $_POST['email'])) echo'請輸入正確的電子信箱格式!';
                        echo'</div>
                    </div>                         
                    <div class="form-group row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-5">
                            <label>
                                <button type="submit" class="btn btn-primary" >儲&emsp;存</button>
                                <button type="reset" class="btn btn-primary">重　填</button>
                            </label>
                        </div>
                    </div>
                </form>            
            ';
            }
            else 
            {
                if($rows!="")
                {
                    echo'
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="modal-title" id="exampleModalLabel"></div>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div style="display:none" id="item_id"></div>
                            <div style="display:none" id="item_order"></div>
                            <div class="container">
                            <div class="row align-items-center" id="item_name"></div>
                            </div>
                            <label class="col-form-label">評分(此處為匿名評分):</label>
                            <div class="form-group">  
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="r" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">1</label>
                                </div>
                                
                                <div class="form-check form-check-inline" >
                                    <input class="form-check-input" type="radio" name="r" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="r" id="inlineRadio3" value="3" >
                                    <label class="form-check-label" for="inlineRadio3">3</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="r" id="inlineRadio4" value="4" >
                                    <label class="form-check-label" for="inlineRadio4">4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="r" id="inlineRadio5" value="5" checked>
                                    <label class="form-check-label" for="inlineRadio5">5</label>
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="message-text" class="col-form-label">為這本書留下評論吧(非匿名，可不填寫):</label>
                              <textarea class="form-control" id="message-text"></textarea>
                            </div>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                          <button type="button" class="btn btn-info" onclick="review()">送出評論</button>
                        </div>
                      </div>
                    </div>
                  </div>
                    ';
                }
                echo'                <div style="margin-top:5px"></div>
                <div class="row">
                    <div class="col-md-8 "></div>
                    <div class="col-md-4 ">
                        <form class="form-inline" name="form_search" id="form_search" action="orderlist.php"
                            method="POST">
                            <div class="input-group">
                                <input class="form-control" aria-label="Search" type="text" id="key_2" name="key_2"
                                    placeholder="請輸入訂單編號"';
                if(isset($_POST['key_2'])) echo 'value="'.$_POST['key_2'].'"';
                echo'>
                                    <button class="btn text-white" type="submit"style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
                                            background-blend-mode: multiply,multiply;">訂單搜尋
                                    </button>
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
                                <th scope="col" >品名</th>
                                <th scope="col" >數量</th>
                                <th scope="col" >單價</th>
                                <th scope="col" class="text-center">評論</th>
                                <th scope="col" class="text-right">取消訂單</th>
                            </tr>
                        </thead>
                        <tbody>';
                echo $rows ;
                echo '</tbody>
                    </table>
                </div>';
            }
            ?>
                <div class="row">
                    <?php
                        if(isset($_GET['type'])&&$_GET['type']=="修改個人資料");else{
                        if($index != 0) echo '<a href="members_area.php?index='.($index-1).'"><button class="btn btn-primary">
                        上一頁
                    </button></a>';
                        if(($index+1)*10 <= $count) echo '&emsp;<a href="members_area.php?index='.($index+1).'"><button class="btn btn-primary">
                        下一頁
                    </button></a>';}
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