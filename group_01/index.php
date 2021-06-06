<?php
$link = mysqli_connect("localhost", "root", "root123456", "group_01") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$i=0;
$data="";
// 送出查詢的SQL指令

if ($result = mysqli_query($link, "SELECT * FROM product order by id")) {
while ($row = mysqli_fetch_assoc($result)) {
$data .= "<div class='col-lg-4 col-md-4 all $row[type]'>
                      <div class='product-item'>
                        <a href='product.php?id=$row[id]'><img src='assets/images/$row[file_name]' alt=''></a>
                        <div class='down-content'>
                          <a href='product.php?id=$row[id]'><h4>Tittle goes here</h4></a>
                          <b>$row[name]</b>
                          <h6>$row[money]</h6>
                          <p>$row[about]</p>
                        </div>
                      </div>
                    </div>";
    $i++;   
    if($i==6)
      break;             
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

    <title>Book</title>

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
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="products.php">產品</a>
              </li>
              <?php session_start();
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
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
        </div>
        <div class="banner-item-02">
        </div>
        <div class="banner-item-03">
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <div class="latest-products">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>最新產品</h2>
              <a href="products.php">看更多 <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
          <?php echo $data?>
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
