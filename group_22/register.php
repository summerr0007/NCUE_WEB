<?php
    $page = 3;
    session_start();
    if(isset($_SESSION['user_id']))
        header("location:index.php");
    if(isset($_POST['account']) and isset($_POST['password']) and isset($_POST['email']))
    {
        $account = $_POST['account'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        include "link.php";//連到資料庫
        $sql = "insert into members values ('$account','$password','$email',2,0)";//2是一般會員的等級
        if($result = mysqli_query($link,$sql))
            header("location:login.php?register_s=1");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>註冊/register</title>
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function($){
            $.validator.addMethod(
                "have_same_account",
                function(value,element){
                    var f = 1;
                    $.ajax({
                        type:"GET",//傳送方式
                        url:'sendto_check_ajax.php',//傳送目的地
                        async:false,
                        data:{//傳送資料
                            'account':value,
                            'timestamp':(new Date().getTime())
                            },
                        success:function (msg) {
                            if(msg == '1')
                            {
                                f = 0;
                            }
                        }
                    });
                    if(f==0){
                        return false;
                    }else{
                        return true;
                    }    
                }, 
                ""
            );
            $("#form_reg").validate({
                submitHandler : function(form){
                    // alert("您已註冊成功!!");
                    form.submit();
                },
                rules:{
                    agree:{
                        required:true
                    },
                    account:{
                        have_same_account:true,
                        required:true,
                        minlength:5,
                        maxlength:12
                    },
                    password:{
                        required:true,
                        minlength:8,
                        maxlength:12
                    },
                    password2:{
                        required:true,
                        equalTo:"#password"
                    },
                    email:{
                        required:true,
                        email:true
                    }
                },
                messages:{
                    agree:{
                        required:"必填"
                    },
                    account:{
                        required:"帳號這行為必填的欄位",
                        minlength:"帳號長度必須不小於5",
                        maxlength:"帳號長度必須不大於12",
                        have_same_account:"帳號名已被使用!"
                    },
                    password:{
                        required:"密碼這行為必填的欄位",
                        minlength:"密碼長度必須不小於8",
                        maxlength:"密碼長度必須不大於12"
                    },
                    password2:{
                        required:"密碼確認這行為必填的欄位",
                        equalTo:"兩次密碼並不相同，請重新輸入!"
                    },
                    email:{
                        required:"E-mail這行為必填欄位",
                        email:"請輸入正確的電子信箱格式!"
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
    <style type="text/css">
    .error {
        color: red;
        font-weight: bold;
    }

    #ajax_check {
        color: red;
    }
    body {
     padding-top: 100px;
        font-family: "微軟正黑體";
        background-image: linear-gradient(to bottom right, white 40%, #dfe9f3 100%);
        }
    </style>
</head>
<body>
    <?php include "header.php";?>

    <div class="container-fluid" align="center">
        <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
            <h2>會員註冊</h2>
            <form class="form-horizontal" role="form" id="form_reg" name="form_reg" action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-4 control-label" for="account">帳號</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="account" name="account" placeholder="限5-12個字">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 control-label">密碼</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password" name="password" placeholder="限8-12個字">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 control-label">密碼確認</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="重新輸入密碼">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 control-label">E-mail</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" name="email" placeholder="格式如:MyEmail@gmail.com">
                    </div>
                </div>
                <label id="ajax_check"></label>
                <div class="form-group">
                    <div class="col-sm-7s col-sm-offset-5">
                        <label>
                            <button type="submit" class="btn btn-primary">送　出</button>
                            <button type="reset" class="btn btn-primary">重　填</button>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include "footer.php";?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>