<?php
session_start();
$link = mysqli_connect("localhost", "root", "root123456", "group_01") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");
$sql = "SELECT * FROM m_data";
// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
// // 資料庫查詢(送出查詢的SQL指令)
$rows = "";
$cgaccount="";
$cgpassword="";
$cgemail="";
$useraccount="";
$userpassword="";
$useremail="";
$user=$_SESSION['account'];
$checkaccount="";
$test="";
// 資料庫查詢
if ($result = mysqli_query($link, "SELECT * FROM member where account = '$user'")) {
    if($row = mysqli_fetch_assoc($result))
    {
    	$useraccount="$row[account]";
    	$userpassword="$row[password]";
    	$useremail="$row[email]";
    	if($useremail == "")
    		$useremail = "您尚未設定email";
    }
    mysqli_free_result($result); // 釋放佔用的記憶體
}
if (isset($_POST['account'])) { 
	  $cgaccount = $_POST['account']; 
	  if ($result = mysqli_query($link, "SELECT * FROM member where account = '$cgaccount'")) {
	  	if($row = mysqli_fetch_assoc($result))
    	{
    		$checkaccount="$row[account]";
    	}
    	if($checkaccount != "" && $checkaccount != $cgaccount)
	  		echo  '<script>alert("該帳號已存在,請另取帳戶名!")</script>';
	  	else if($checkaccount != "" && $checkaccount == $cgaccount)
			echo  '<script>alert("與帳戶名相同!")</script>';
	  	else
	  	{
    	  	mysqli_query($link, "UPDATE member SET account='".$cgaccount."' WHERE account = '". $user ."'");
    	  	mysqli_query($link, "UPDATE cart SET account='".$cgaccount."' WHERE account = '". $user ."'");
    	  	$_SESSION['account'] = $cgaccount;
    	  	$useraccount = $cgaccount;
    	  	header('Location: member.php');
    	  	exit();
  		}
	}
  	mysqli_free_result($result); // 釋放佔用的記憶體
}  
if (isset($_POST['password2'])) { 
	  $cgpassword = $_POST['password2']; 
      mysqli_query($link, "UPDATE member SET password='".$cgpassword."' WHERE account = '". $user ."'");
      $useraccount = $cgaccount;
      header('Location: member.php');
      exit();
}  
if (isset($_POST['email'])) { 
	  $test="fku";
	  $cgemail = $_POST['email']; 
      mysqli_query($link, "UPDATE member SET email='".$cgemail."' WHERE account = '". $user ."'");
      $useraccount = $cgaccount;
      header('Location: member.php');
      exit();
}  
mysqli_close($link); // 關閉資料庫連結

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book</title>

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

    $("#contact1").validate({
    rules: {
        account:{
          minlength: 4,
          maxlength: 10
        }
    },
    messages: {
      account:{
      	  required: "若要更改帳號則必填",
          minlength: "帳號最少要4個字",
          maxlength: "帳號最長10個字"
        }
    }
  });
    $("#contact2").validate({
    rules: {
        password: {
            minlength: 6,
            maxlength: 15
        }
    },
    messages: {
      password:{
          minlength: "　 密碼最少要6個字",
          maxlength: "　 密碼最長15個字"
        }       
    }
  });
    $("#contact3").validate({
    rules: {
        password2: {
            minlength: 6,
            maxlength: 15,
            equalTo: "#password"
        }
    },
    messages: {
        password2: {
        	required: "若要更改帳號則必填",
            equalTo: "兩次密碼不相符"
        },
       
    }
  });
    $("#contact4").validate({
    messages: {
        email: {
        	required: "若要更改email則必填",
        },
       
    }
  });
  });
  </script>
      <script>
  function isHidden(oDiv,cDiv){
      var vDiv = document.getElementById(oDiv);
      var xDiv = document.getElementById(cDiv);
      vDiv.style.display = 'block';
      xDiv.style.display = 'none';
    }
</script>
  <style type="text/css">
.error {
     color: #D82424;
     padding: 1px;
}
</style>
  </head>

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
                echo '<li class="nav-item"><a class="nav-link" href="logout.php">登出</a></li>';
                echo '<li class="nav-item"><a class="nav-link active" href="datatable.php">' . $_SESSION['account'] . '</a></li>';
              } else {
                echo '<li class="nav-item"><a class="nav-link" href="contact.php">登入</a></li>';
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
              <h4>Account</h4>
              <h2>更改帳戶資訊</h2>
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
              <button type="button" id="form-submit1" class="btn btn-danger" style="width:114px;height:47.6px;font-size:20px;" onclick="isHidden('div1','div2')">您的資料</button>
              <button type="button" id="form-submit2" class="btn btn-danger" style="width:114px;height:47.6px;font-size:20px;" onclick="isHidden('div2','div1')">更改資料</button>
            </div>
            <div class="contact-form" id='div1'>
            	<h3>您的帳號: <?php echo "$useraccount"; ?> </h3><br>
            	<h3>您的密碼: <?php echo "$userpassword"; ?> </h3><br>
            	<h3>您的email: <?php echo "$useremail"; ?> </h3>
            </div>
            <div class="row" id='div2' style='display:none'>
      			<div class="col-lg-12">
            		<tr>
            			<td>
            				<form action="" method="post" id="contact1">
            		    		<font size="4">更改帳號: </font>
            		    		<input type="text" size="50" name="account" id="account" placeholder="Account Number" required="" style="position: relative; left: 15px; color: black;">
            		    		<button type='submit' class="btn btn-danger" style="position: relative; left: 15px;">更改</button>
            		    		<label for="account" class="error" style="position: relative; left: 15px;"></label>
            		    	</form>
            		    </td>                          
            		</tr>
            		<br>
        		</div>
        		<div class="col-lg-12">
            		<tr>
                		<td>
                			<form action="" method="post" id="contact2">
                    			<font size="4">更改密碼: </font>
                    			<input type="password" size="50" name="password" id="password" placeholder="Password" style="position: relative; left: 15px; color: black;">
                   		 		<label for="account" class="error"></label>
                    		</form>
                		</td>
            		</tr>
            		<br>
            	</div>
        		<div class="col-lg-12">
            		<tr>
                		<td>
                			<form action="" method="post" id="contact3">
                	    		<font size="4">確認密碼: </font>
                	    		<input type="password" size="50" name="password2" id="password2" placeholder="Repeat password" required="" style="position: relative; left: 15px; color: black;">
                				<button type='submit' class="btn btn-danger" style="position: relative; left: 15px;">更改</button>
                				<label for="password2" class="error" style="position: relative; left: 15px;"></label>
               				</form>
                		</td>
            		</tr>
            		<br>
        		</div>
        		<div class="col-lg-12">
            		<tr>	
            		    <td>
            		    	<form action="" method="post" id="contact4">
            		      		<font size="4">更改email: </font>
            		        	<input type="email" size="50" name="email" id="email" placeholder="email" required="" style="color: black;">
            		    		<button type='submit' class="btn btn-danger" required="">更改</button>
            		    		<label for="email" class="error"></label>
            		    		<?php echo $test; ?>
            		   		</form>
            		    </td>
            		</tr>
        		</div>
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
