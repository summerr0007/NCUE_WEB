<?php
    if (isset($unlogin) && $unlogin==true) {
        echo "<script>";
        echo "alert('請先登入');";
        echo "window.location.href='" . THISURL . "account/login/';";
        echo "</script>";
        // header("Location: ".THISURL."account/login/"); 
        exit;
    }
?>

<script>
    var watch = function(){
        alert("沒有電影但有Rick");
        location.href = "https://youtu.be/dQw4w9WgXcQ";
    }
</script>

<div class="container-xxl">
    <div class="row">
        <div class="col-2">
            <aside>
                <ui class = "nav flex-column nav-pills mt-5 border border-2 rounded border-primary">
                    <li class="nav-item">
                        <a class="nav-link link-dark" style="background-color:gray;">個人資料管理</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href='<?php echo THISURL."account/edit"?>'>修改密碼</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active">訂單管理</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo THISURL.'account/logout';?>">登出</a>  
                    </li>
                </ui>
            </aside>
        </div>
        <div class="col-8 ms-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>品名</th>                        
                        <th>授權</th>
                        <th>立刻觀看</th>
                    </tr>
                </thead>
                <tbody id="soldlist">
                    <?php foreach($result as $key => $value):?>
                        <tr>
                            <td><?php echo $key+1;?></td>
                            <td><?php echo $value['name'];?></td>
                            <td>終生授權</td>
                            <td><button type="button" class="btn btn-success btn-sm" onclick="watch()">立刻觀看</button></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>