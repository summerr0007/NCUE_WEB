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
                    <form class="form-inline" name="form_search" id="form_search" action="itemlist.php" method="POST">
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
          <li class="nav-item <?php if($page==4) echo "active";?>">
            <a class="nav-link" href="shop_cart.php">購物車</a>
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