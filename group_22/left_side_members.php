<!-- <div class="col-lg-12">
    <div class="card my-2" >
        <h1 class="my-4">系統公告:NMSL</h1>
    </div>
</div> -->

<div class="col-lg-2">
    <div style = "margin-top:50px"></div>
    <div class="list-group">
        <li class="list-group-item text-white" style="background-image: linear-gradient(to top, #09203f 0%, #537895 100%);">會員功能</li>        
                <a href="members_area.php" class="list-group-item list-group-item-action 
                <?php
                    if($_SERVER['PHP_SELF']=="/group_22/members_area.php")
                    {
                        if(isset($_GET["type"])&&$_GET["type"]=="修改個人資料");
                        else
                            echo"disabled";
                    }  
                ?>"
                <?php
                    if($_SERVER['PHP_SELF']=="/group_22/members_area.php")
                    {
                        if(isset($_GET["type"])&&$_GET["type"]=="修改個人資料");
                        else
                            echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";
                    }  
                ?>>訂單管理</a>
                <a href="members_area.php?type=修改個人資料" class="list-group-item list-group-item-action
                <?php
                    if(isset($_GET["type"])&&$_GET["type"]=="修改個人資料") 
                        echo"disabled";?>"
                <?php
                    if(isset($_GET["type"])&&$_GET["type"]=="修改個人資料") 
                        echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";?>>修改個人資料</a>
                        
                <a href="logout.php" class="list-group-item list-group-item-action" >登出</a>
        <!-- <a href="members_area.php" class="list-group-item list-group-item-action ">訂單管理</a>
        <a href="members_area.php?type=修改個人資料" class="list-group-item list-group-item-action">修改個人資料</a>
        <a href="logout.php" class="list-group-item list-group-item-action ">登出</a> -->
    </div>
</div>