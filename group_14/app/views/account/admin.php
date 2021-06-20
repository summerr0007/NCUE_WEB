<?php
    if ((isset($unlogin) && $unlogin==true)) {
        echo "<script>";
        echo "alert('不行');";
        echo "window.location.href='" . THISURL . "account/login/';";
        echo "</script>";
        // header("Location: ".THISURL."account/login/"); 
        exit;
    }
?>

<script>
    var addsubmit = function(){
        document.getElementById('newaccform').submit();
    }
</script>

<div class="container-xxl">
    <div class="row">
        <div class="col-2">
            <aside>
                <ui class = "nav flex-column nav-pills mt-5 border border-2 rounded border-primary ">
                    <li class="nav-item">
                        <a class="nav-link link-dark" style="background-color:gray;">系統資料管理</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href='<?php echo THISURL."item/itemedit"?>'>修改商品</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href='<?php echo THISURL."account/admin"?>'>管理會員</a>  
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo THISURL.'account/logout';?>">登出</a>  
                    </li>
                </ui>
            </aside>
        </div>
        <div class="col-8 ms-5">
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-success " data-bs-toggle='modal' data-bs-target='#add'>新增會員</button>
            </div>
            <table class="table table-striped text-break table-hover" id="itemtable">
                <thead>
                    <tr>
                        <th>MemberId</th>
                        <th>帳號</th>
                        <th>操作</th>
                        
                    </tr>
                </thead>
                <tbody id="soldlist">
                    <?php foreach($items as $key => $item):?>
                        <tr>
                            <td><?php echo $item['MemberId'];?></td>
                            <td><?php echo $item['account'];?></td>
                            <td><button class="btn btn-danger " onclick="location.href='<?php echo THISURL."account/delacc/".$item['MemberId']; ?>'">刪除</button></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="add" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Label">新增會員</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        <form method='POST' action="<?php echo THISURL; ?>account/addacc" id="newaccform" enctype='multipart/form-data'>
            <label for="Account" class="form-label">Account</label>
            <input type="text" class="form-control" name="account" >
            <label for="Password" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" >
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onclick="addsubmit()">確定</button>
      </div>
    </div>
  </div>
</div>