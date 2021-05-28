<?php
    $page = 2;
    session_start();
    if(isset($_SESSION['user_id']))
        // 跳轉頁面
        header("location: index.php");
$cause_error = false;
if(isset($_POST['account']) and isset($_POST['password']))
{
    $account = $_POST['account'];
    $password = $_POST['password'];
    include "link.php";
    $sql = "select * from members where account='$account'
    and password='$password' ";
    if($result = mysqli_query($link,$sql))
    {
        if($row = mysqli_fetch_assoc($result))
        {
            $_SESSION['level'] = $row['level'];
            $_SESSION['user_id'] = $row['account'];
            header("location: index.php?login_s=1");//導向index.php
        }
        else $cause_error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>登入/login</title>
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function($) {
            $("#form_login").validate({
                submitHandler : function(form){
                    form.submit();
                },

                rules:{
                    account:{
                        required:true,
                        minlength:5,
                        maxlength:12 
                    },
                    password:{
                        required:true,
                        minlength:8,
                        maxlength:12 
                    }
                },

                messages:{
                    account:{
                        required:"帳號這行為必填的欄位",
                        minlength:"帳號長度必須不小於5",
                        maxlength:"帳號長度必須不大於12"
                    },
                    password:{
                        required:"密碼這行為必填的欄位",
                        minlength:"密碼長度必須不小於8",
                        maxlength:"密碼長度必須不大於12"
                    }
                }
            })
        });

    </script>
    <script> 
        var top1 = 0;
        $(document).ready(function(){
            const $ScrollWrap = $("#scroll-wrap")
            // 监听滚动停止
            let t1 = 0;
            let t2 = 0;
            let timer = null; // 定時器
            $(window).on("touchstart", function(){
                // 觸控開始
            })
            $(window).on("scroll", function(){
                // 滾動
                clearTimeout(timer)
                timer = setTimeout(isScrollEnd, 100)
                t1 = $(this).scrollTop()
            })
            function isScrollEnd() {
                t2 = $(window).scrollTop();
                if(t2 == t1){
                    if(t2>top1)
                    {
                        top1=t2;
                        $("nav").slideUp();
                    }
                    else if(t2<top1)
                    {
                        top1=t2;
                        $("nav").slideDown();
                    }
                    clearTimeout(timer)
                }
            }
        })
    </script>    
    <script src="js/in_cart.js"></script>
    <style type="text/css">
    .error {
        color: red;
        font-weight: bold;
    }
    body {
        padding-top: 100px;
        font-family: "微軟正黑體";
        background-image: linear-gradient(to bottom right, white 40%, #dfe9f3 100%);
    }
    </style>
</head>

<body <?php if(isset($_GET['register_s'])&&$_GET['register_s']==1){ echo'onload="Swal.fire({';
            echo"position: 'top',";
            echo"	icon: 'success',";
            echo"	title: 'A',";
            echo"   text: '註冊成功，請重新登入!',";
            echo'	showConfirmButton: false,';
            echo"  backdrop: `
            rgba(56,110,170,0.4)";
            echo"url('./images/cat_small.gif')";
            echo"left bottom
            no-repeat
          `
            
                }).then(() => {";
            echo"			window.location.href = 'login.php';";
            echo'		    })"';}?>>
    <?php include "header.php"; ?>
    <div class="container-fluid" align="center">
        <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
            <h2>會員登入</h2>
            <form class="form-horizontal" role="form" id="form_login" action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-4 control-label" for="account">帳號</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="account" name="account" placeholder="長度為5-12個字">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 control-label">密碼</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="長度為8-12個字">
                    </div>
                </div>
                <div class="form-group">
                    <label class="error">
                        <?php echo $cause_error ? "帳號或密碼錯誤":"";?></label>
                    <div class="col-sm-7s col-sm-offset-5">
                        <label>
                            <button type="submit" class="btn btn-primary">登入</button>
                            <button type="reset" class="btn btn-primary">重填</button>   
                        </label>
                    </div>
                    <div class="col-sm-7s col-sm-offset-5">
                        <label>
                            <button type="button" class="btn btn-primary" onClick='redir("register","",0)'>註冊</button>
                            <button type="button" class="btn btn-primary" onClick='redir("forget_password","",0)'>忘記密碼</button>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer -->
    <?php include "footer.php"; ?>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>