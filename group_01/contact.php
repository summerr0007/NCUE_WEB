<?php
session_start(); 
$link = mysqli_connect("localhost", "root", "root123456", "group_01")or die("無法開啟MySQL資料庫連結!<br>");

$account = (isset($_POST['account']) == TRUE)? $_POST['account'] : '';
$password = (isset($_POST['password']) == TRUE)? $_POST['password'] : '';

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

// 資料庫查詢
$result = mysqli_query($link, "SELECT * FROM member where account = '$account' and password = '$password'");

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
$row = mysqli_num_rows($result);
if(!isset($_SESSION['account']))
{
  if (isset($_POST['form-submit']))
  {
    if($account != null && $password != null && $row)
    {
      //將帳號寫入session，方便驗證使用者身份
      $_SESSION['account'] = $account;
      $_SESSION['password'] = $password;
      if ($_POST['account'] == "admin" && $_POST['password'] == "admin123456") {
        $_SESSION['level'] = 9; //管理者
      }
      else
        $_SESSION['level'] = 2; //一般會員
      echo '<meta http-equiv=REFRESH CONTENT=0;url=index.php>'; //延遲0秒跳到首頁
      echo '<script>alert("登入成功!")</script>';
    }
    else
    {
      echo '<script>alert("登入失敗")</script>';
      echo '<meta http-equiv=REFRESH CONTENT=0;url=contact.php>'; //延遲零秒重新整理
    }
  }
}
else
{
  echo '<script>alert("你已經登入!!'.$_SESSION["account"].'")</script>';
  echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}

//session_unset();

mysqli_free_result($result); 
mysqli_close($link); // 關閉資料庫連結
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book - Contact Page</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <!--additional method - for checkbox .. ,require_from_group method ...-->
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<!--中文錯誤訊息-->
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>
    <script>
    $(document).ready(function($) {
    //for select
    $.validator.addMethod("notEqualsto", function(value, element, arg) {
        return arg != value;
    }, "您尚未選擇!");

    $("#contact").validate({
    rules: {
        account:{
          minlength: 4,
          maxlength: 10
        },
        password: {
            minlength: 6,
            maxlength: 15
        },
    },
    messages: {
      account:{
          minlength: "帳號最少要4個字",
          maxlength: "帳號最長10個字"
        },
    }
  });
  });
  </script>
  </head>
  <style type="text/css">
.error {
     color: #D82424;
     padding: 1px;
}
</style>
  <body>

    <!-- ***** Preloader Start ***** -->
     <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>社長 <em>眼鏡</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="products.php">產品</a>
              </li>
              <?php
              if (isset($_SESSION['account'])) {
                echo '<li class="nav-item"><a class="nav-link" href="cart.php">購物車</a></li>';
              } else {
                echo '<li class="nav-item"><a class="nav-link" href="contact.php">購物車</a></li>';
              }
              ?>
              <li class="nav-item"> 
                <a class="nav-link" href="about.php">網路商店介紹</a>
              </li>
              <?php
              if (isset($_SESSION['account'])) {
                echo '<li class="nav-item"><a class="nav-link active" href="logout.php">登出</a></li>';
                if($_SESSION['level']==2)
                  echo '<li class="nav-item"><a class="nav-link active" href="member.php">' . $_SESSION['account'] . '</a></li>';
                else
                  echo '<li class="nav-item"><a class="nav-link active" href="datatable2.php">管理介面</a></li>';
              } else 
              {
                echo '<li class="nav-item"><a class="nav-link active" href="contact.php">登入</a></li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- Page Content -->
    <div class="page-heading contact-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Sign in</h4>
              <h2>登入帳號來購買您的眼鏡</h2>
            </div>
          </div>
        </div>
      </div>
    </div>    
    <div class="send-message">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>登入您的帳號</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div class="contact-form">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input name="account" type="text" class="form-control" id="account" placeholder="Account Number" required="" style="color: black;">
                    </fieldset>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <fieldset>
                      <input name="password" type="password" class="form-control" id="password" placeholder="Password" required="" style="color: black;">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button name="form-submit" type="submit" id="form-submit" class="filled-button">登入</button>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <a href="sign.php">建立帳號 <i class="fa fa-angle-right"></i></a>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <?php include("footer.php"); ?>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>


  </body>

</html>
