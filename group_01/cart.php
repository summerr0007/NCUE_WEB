  <?php
  session_start();
  $link = mysqli_connect("localhost", "root", "root123456", "group_01") // 建立MySQL的資料庫連結
  or die("無法開啟MySQL資料庫連結!<br>");
  // 送出編碼的MySQL指令
  mysqli_query($link, 'SET CHARACTER SET utf8');
  mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");    
  $id=(isset($_GET['id']))?$_GET['id']:0;
  $user = $_SESSION['account'];
  $data = "";
  $allcost = 0;
  if(empty($row)) 
  if ($result = mysqli_query($link, "SELECT * FROM cart where account = '$user'" )) {
      while ($row = mysqli_fetch_assoc($result)) { 
          $allcost = $allcost + $row["cost"]*$row["nums"];              
          $data .= "<tr><td align = 'center' valign='center'><img src='assets/images/".$row['id']."' height='100' width='100'></td><td align = 'center' valign='center' style='font-size:18px;'>" . $row["product_name"] . "</td><td align = 'center' valign='center' style='font-size:18px;'>" . $row["product_price"] . "</td><td align = 'center' valign='center' style='font-size:18px;'>" . $row["nums"] . "</td><form action='' method='POST'>
          <td align = 'center' valign='center'><button type='submit' class='btn btn-danger btn-xs' onclick='remove(" .'"'. $row["product_name"] .'"'.")'><i class='fa fa-times' aria-hidden='true'></i></button></td></form>";
      }
      mysqli_free_result($result); // 釋放佔用的記憶體
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

    <title>Cart</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <script src="//code.jquery.com/jquery-latest.min.js"></script>
    <script>
    	function remove(name)
    	{
    		  var xhttp = new XMLHttpRequest();
        	xhttp.onreadystatechange = function() {
          	if (this.readyState == 4 && this.status == 200) {
                document.getElementById("intro").innerHTML = this.responseText;
          	}
        	};
        	xhttp.open("GET", "remove.php?product="+name, true);
        	xhttp.send();
		  }
    </script>
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
                echo '<li class="nav-item active"><a class="nav-link" href="cart.php">購物車</a></li>';
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
                if($_SESSION['level']==2)
                  echo '<li class="nav-item"><a class="nav-link" href="member.php">' . $_SESSION['account'] . '</a></li>';
                else
                  echo '<li class="nav-item"><a class="nav-link" href="datatable2.php">管理介面</a></li>';
              } else 
              {
                echo '<li class="nav-item"><a class="nav-link" href="contact.php">登入</a></li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="page-heading cart-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>confirm commodities</h4>
              <h2>確認您的商品</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="container">
     <?php if($data != "")echo "<table align='center' class='table table-striped table-responsive'>   
  <tr align='center'>
  	  <br>
      <th scope='col' width='200' class='div_title'>商品圖片</th>
      <th scope='col' width='200' class='div_title'>商品名稱</th>
      <th scope='col' width='200' class='div_title'>商品價錢</th>
      <th scope='col' width='200' class='div_title'>購買數量</th>
      <th scope='col' width='200' class='div_title'>移除商品</th>
    </tr>
    " . $data . " <tr>
  </table><h3 align='right' font-size='30px'>總價: " . $allcost . "　</h3>";
            else{
              echo "<br><h2 align='center'>購物車裡什麼也沒有！</h2>";}
      ?>
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
