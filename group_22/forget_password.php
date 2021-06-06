<?php
    $page = 6;
    session_start();
    if(isset($_SESSION['user_id']))
        header("location : index.php");
    $h = "";
    $cause_error = false;
    if(isset($_POST['account']) and isset($_POST['email']))
    {
        $account = $_POST['account'];
        $email = $_POST['email'];
        include "link.php";
        $sql = "select * from members where account='$account' 
        and email='$email'";
        if($result = mysqli_query($link,$sql))
        {
            if($row = mysqli_fetch_assoc($result))
            {
                $password = $row['password'];
                for($i = 0;$i < strlen($password);$i++)
                    $h .= ($i % 2 == 0 ? "*":$password[$i]);
            }
            else    $cause_error = true;
        }
        else $cause_error = true;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>忘記密碼</title>
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $("#form_forgetpass").validate({
                submitHandler:function(form){
                    form.submit();
                },
                rules:{
                    account:{
                        required:true,
                        minlength:5,
                        maxlength:12
                    },
                    email:{
                        required:true,
                        email:true 
                    },
                },

                messages:{
                    account:{
                        required:"帳號這行為必填的欄位",
                        minlength:"帳號長度不小於5",
                        maxlength:"帳號長度不大於12"
                    },
                    email:{
                        required:"E-mail這行為必填欄位",
                        email:"E-請輸入正確的電子信箱格式!" 
                    },
                }
            })
        });

    </script>
    <script> 
        // var top1 = 0;
        // $(document).ready(function(){
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
    <script src="js/in_cart.js"></script>
    <style type="text/css">
    .error {
        color: red;
        font-weight: normal;
    }
    body {
        padding-top: 100px;
        font-family: "微軟正黑體";
        background-image: linear-gradient(to bottom right, white 40%, #dfe9f3 100%);
    }
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container-fluid" align="center">
        <div class="col-sm-offset-4 col-sm-4 col-sm-offset-4">
            <h2>忘記密碼</h2>
            <form class="form-horizontal" role="form" id="form_forgetpass" action="" method="POST">
                <div class="form-group row">
                    <label class="col-sm-4 control-label" for="account">帳號</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="account" name="account" placeholder="長度為5-12個字">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 control-label">E-mail</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="emal" name="email" placeholder="請輸入E-mail">
                    </div>
                </div>
                <div class="form-group">
                    <label class="error">
                        <?php echo $cause_error ? "帳號或E-mail輸入錯誤":"";?></label>
                    <div class="col-sm-offset-2 col-sm-8 col-sm-offset-2">
                        <label>
                            <button type="submit" class="btn btn-primary">取得密碼</button>
                            <button type="reset" class="btn btn-primary">重填</button>
                        </label>
                    </div>
                </div>
            </form>
            <label>
            <?php echo (!$cause_error and isset($_POST['account'])) ? "密碼提示(只顯示偶數字): $h":"";?>
            </label>
        </div>
    </div>
    <!-- Footer -->
    <?php include "footer.php"; ?>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>