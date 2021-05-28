<?php
$link = mysqli_connect("localhost", "root", "root123456", "group_01") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$id=(isset($_GET['id']))?$_GET['id']:0;
$data="";
$money="";
$about="";
$images="";
$type="";
$shape="";
$apple="";
$maki="";
$nico=1;
$i=0;
// 送出查詢的SQL指令
session_start();
if (isset($_SESSION['cart'])) {
        $cnt = count($_SESSION['cart']);
    } else {
        $cnt = 10;
    }   
if ($result = mysqli_query($link, "SELECT * FROM product order by id")) {
while ($row = mysqli_fetch_assoc($result)) {
  if("$row[id]"==$id){
  $data .= "$row[name]";
  $money .= "$row[money]";
  $about .= "$row[about]";
  $images .= "$row[file_name]";
  $type .= "$row[type]";
  $shape .= "$row[shape]";
  $url='product.php?id='.$id;
}
}
$result = mysqli_query($link, "SELECT * FROM product order by rand()");
while ($row = mysqli_fetch_assoc($result)) {
  if($shape=="$row[shape]"&&$data != "$row[name]"&&$i<3){
  $apple .= "<div class='col-lg-4 col-md-4 all $row[type]'>
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
}
}
mysqli_free_result($result); // 釋放佔用的記憶體
}
if (isset($_POST['c8763'])&&$_POST['doc_detail']!="") {
      $sql = "insert into evaluate values ('" . $data . "','" . "桐谷和人" . "','" . $_POST['doc_detail']. "','". $year."','". $month."','". $day."','". $hours."','". $minutes."')";
      if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
      {
          $msg = "<span style='color:#0000FF'>資料新增成功!</span>";
          
      } else {
          $msg = "<span style='color:#FF0000'>資料新增失敗！<br>錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link) . "</span>";
      }
      header('Location:' .$url);
      exit();
  } 
if($result =mysqli_query($link, "SELECT * FROM evaluate ")){ 
  while ($row = mysqli_fetch_assoc($result)) {
    if("$row[product]"==$data){
    $maki.="<h6>評價 $nico.&nbsp&nbsp&nbsp&nbsp$row[name]&nbsp&nbsp$row[date]-$row[month]-$row[day]&nbsp$row[hours]:$row[minutes]</h6><br>&nbsp&nbsp$row[evaluation]<br><hr>";
    $nico++;
}
}
  mysqli_free_result($result);
}
if (isset($_POST['buy'])) { session_start();
      $sql = "insert into cart values ('" . $_SESSION['account'] . "','" . $data . "','" . $money . "','" . $images . "')";

      if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
      {
          $msg = "<span style='color:#0000FF'>資料新增成功!</span>";
      } else {
          $msg = "<span style='color:#FF0000'>資料新增失敗！<br>錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link) . "</span>";
      }
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


    <title>book</title>

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
    <script>
  function isHidden(oDiv,cDiv){
      var vDiv = document.getElementById(oDiv);
      var xDiv = document.getElementById(cDiv);
      vDiv.style.display = 'block';
      xDiv.style.display = 'none';
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
              <li class="nav-item active">
                <a class="nav-link" href="products.php">產品</a>
              </li>
              <?php session_start();
              if (isset($_SESSION['account'])) {
                echo '<li class="nav-item"><a class="nav-link" href="cart.php">購物車<span class="badge alert-danger">'."$cnt". '</span></a></li>';
              } else {
                echo '<li class="nav-item"><a class="nav-link" href="contact.php">購物車<span class="badge alert-danger">'."$cnt". '</span></a></li>';
              }
              ?>
              <li class="nav-item"> 
                <a class="nav-link" href="about.php">網路商店介紹</a>
              </li>
              <?php session_start();
              if (isset($_SESSION['account'])) {
                echo '<li class="nav-item"><a class="nav-link" href="logout.php">登出</a></li>';
                echo '<li class="nav-item"><a class="nav-link" href="logout.php">' . $_SESSION['account'] . '</a></li>';
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
    <div class="page-heading a-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          </div>
        </div>
      </div>
    </div>

    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>商品簡介</h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <img src="assets/images/<?php echo $images?>" height="300" width="300" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="left-content">
              <h3><?php echo $data;?></h3><hr>
              <h5>特價:<?php echo $money;?></h5><hr>
              <h6>型號: <?php echo $about;?><br>形狀： <?php echo $shape;?><br>材質：<?php echo $type;?></h6><hr><br>
              <form action="" method="POST"><input type="submit" name="buy" value="購買" onclick="javascript:location.href='addcartnum.php?id=<?php echo $id;?>'"/></form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="latest-products">
     <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <button type="button" id="form-submit1" class="filled-button btn btn-info btn-lg" onclick="isHidden('div1','div2')">商品圖片</button>
              <button type="button" id="form-submit2" class="filled-button btn btn-info btn-lg" onclick="isHidden('div2','div1')">評論專區</button>
            </div>
            <div class="col-md-6" id="div1">
              <?php  echo $str= '<img src="assets/images/'."$id-1.jpg".'" height="300" width="450" alt="">';?><br>
              <?php  echo $str= '<img src="assets/images/'."$id-2.jpg".'" height="300" width="450" alt="">';?><br>
              <?php  echo $str= '<img src="assets/images/'."$id-3.jpg".'" height="300" width="450" alt="">';?> <br><h2>推薦商品 </h2><hr>
            </div>
            <div class='col-md-12' id='div2' style='display:none'>
            <?php echo $maki;?>
            <div class="col-md-12" colspan="3"><h4>給予評論</h4>
            <form action="" method="POST">
            <textarea style='font-size: 10pt' name='doc_detail' id="doc_detail" rows="7" cols="100" style="font-size:14px;color:blue" class="form-control"></textarea>
           <input type="submit" name="c8763" value="評論"  class="filled-button btn btn-info "/>
         </form>
             </div>
             <br><h2>推薦商品 </h2><hr>
            </div>
          </div>
           </div>
            </div>
             </div>
    <div class="Recommended">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="filters-content">
                <div class="filters">
                <div class="row grid" >
                    <?php echo $apple;?>
                </div>
                </div>
            </div>
          </div>
        </div>  
      </div>
    </div>         

    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright &copy; 2020 Sixteen Clothing Co., Ltd.
            
            - Design: <a rel="nofollow noopener" href="https://templatemo.com" target="_blank">TemplateMo</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>


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
