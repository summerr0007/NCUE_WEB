<div class="col-lg-2">
    <div class="list-group">
        <li class="list-group-item text-white" style="background-image: linear-gradient(to top, #09203f 0%, #537895 100%);">管理者功能</li>        
        <a href="admin_members.php" class="list-group-item list-group-item-action 
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_members.php")
                echo"disabled"; 
        ?>"
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_members.php")
                echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";
        ?>>會員資料管理</a>
        <a href="admin_books.php" class="list-group-item list-group-item-action 
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_books.php")
                echo"disabled"; 
        ?>"
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_books.php")
                echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";
        ?>>商品資料管理</a>
        <a href="admin_user_books.php" class="list-group-item list-group-item-action 
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_user_books.php")
                echo"disabled"; 
        ?>"
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_user_books.php")
                echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";
        ?>>退貨管理</a>
        <a href="admin_reviews.php" class="list-group-item list-group-item-action 
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_reviews.php")
                echo"disabled"; 
        ?>"
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_reviews.php")
                echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";
        ?>>留言管理</a>
        <a href="admin_post.php" class="list-group-item list-group-item-action 
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_post.php")
                echo"disabled"; 
        ?>"
        <?php
            if($_SERVER['PHP_SELF']=="/group_22/admin_post.php")
                echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";
        ?>>公告管理</a>                                          
        <a href="logout.php" class="list-group-item list-group-item-action" >登出</a>
    </div>
</div>