<?php
  if(isset($_SESSION['user_id']))
  {
    $row="";
    $cart_count=0;
    // session_start();
    $link = mysqli_connect('localhost','root','root123456','group_22')
    or die("無法開啟MySQL資料庫連結!<br>");
    mysqli_query($link, 'SET CHARACTER SET utf8');
    mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
    // $sql = "select commodity_id from order_form where members_id = '".$_SESSION['user_id']."' and time = 0";
    $sql = "select count(commodity_id) as total from order_form where members_id = '".$_SESSION['user_id']."' and time = 0";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $cart_count = $row['total'];
    // if ($result = mysqli_query($link, $sql)) {
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         $cart_count+=1;
    //     }
    //      mysqli_free_result($result); // 釋放佔用的記憶體   
    // }      
  }
  else
    $cart_count=0;
?>
<!-- <div class="s">好挖</div> -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-image: linear-gradient(to top, #43506c 0%, #537895 100%);">
<!-- <nav class="navbar navbar-light fixed-top" style="background-color: #e3f2fd;"> -->
    <div class="container">
      <a class="navbar-brand" href="index.php">窩不知道叫甚麼書店</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <!-- 搜尋列 -->
            <li class="nav-item">
                    <form class="form-inline" name="form_search" id="form_search" action="index.php" method="POST">
                        <input class="form-control" aria-label="Search" type="text" id="key" name="key" placeholder="想搜尋的物品"
                        <?php if(isset($_POST['key'])) echo 'value="'.$_POST['key'].'"';?>>
                        <button class="btn text-white" type="submit"style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
 background-blend-mode: multiply,multiply;">搜尋</button>
                    </form>
            </li>
            <!-- 首頁 -->
          <li class="nav-item <?php if($page==1) echo "active";?>">
            <a class="nav-link" href="./index.php">首頁</a>
          </li>
          <!-- 註冊 -->
          <?php 
                  if(!isset($_SESSION['user_id'])) echo 
                  '
                    <li class="nav-item ' .(($page==3)?"active":"") .'  ">
                    <a class="nav-link" href="./register.php">會員註冊</a>
                    </li>
                  ';
          ?>  
          <!-- 登陸 -->
          <li class="nav-item <?php if($page==2) echo "active";?>">
            <a class="nav-link" href="
            <?php echo isset($_SESSION['user_id'])?"logout.php":"login.php";?>">
            <?php echo isset($_SESSION['user_id'])?"$_SESSION[user_id] 登出":"登入"?>
            </a>
          </li>
          <!-- 購物車 -->
          <li class="nav-item  <?php if($page==4) echo "active";?>" id="intro_22">
            <a class="nav-link" href="shop_cart.php"><div id="intro_2">購物車(<?php echo $cart_count ;?>)</div></a>
          </li>
          <!-- <li class="nav-item <?php if($page == 5) echo " active"; ?>">
            <a class="nav-link" href="buyed_book.php">
            以前購買書籍</a>
          </li> -->
          <li class="nav-item <?php if($page == 6) echo " active"; ?>">
            <a class="nav-link" href="<?php echo isset($_SESSION['user_id'])?"members_area.php":""; ?>">
            <?php echo isset($_SESSION['user_id'])?"會員專區":""; ?></a>
          </li>
          <?php
              if(isset($_SESSION['level']) and $_SESSION['level'] == 3) echo 
              '<li class="nav-item '.(($page == 7) ?"active":"").'">
              <a class="nav-link" href="admin_members.php">管理者頁面</a>
              </li>';
          ?>
        </ul>
      </div>
    </div>
  </nav>