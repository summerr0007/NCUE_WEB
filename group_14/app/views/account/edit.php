<?php
    if (isset($unlogin) && $unlogin==true) {
        echo "<script>";
        echo "alert('請先登入');";
        echo "window.location.href='" . THISURL . "account/login/';";
        echo "</script>";
        // header("Location: ".THISURL."account/login/"); 
        exit;
    }
    if(!empty($ok)){
        echo "<script>";
        echo "alert('$ok');";
        echo "</script>";
    }
?>
<div class="container-xxl">
    <div class="row">
        <div class="col-2">
            <aside>
                <ui class = "nav flex-column nav-pills mt-5">
                    <li class="nav-item">
                        <a class="nav-link link-dark" style="background-color:gray;">個人資料管理</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active">修改個人資料</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ">訂單管理</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo THISURL.'account/logout';?>">登出</a>  
                    </li>
                </ui>
            </aside>
        </div>
        <div class="col-8 ms-5">
            <main>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="account" class="form-label">新密碼</label>
                        <input type="text" class="form-control" id="old" ></input>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">再輸入一次</label>
                        <input type="password" class="form-control" name="passwd"></input>
                    </div>
                    <input type="submit" class="btn btn-primary" value="修改"></input>
                </form>
            </main>
        </div>
    </div>
</div>