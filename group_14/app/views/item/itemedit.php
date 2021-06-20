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
        document.getElementById('newitemform').submit();
    }   
    var editsubmit = function(){
        document.getElementById('edititemform').submit();
    }

    var fill = function(ii){
        var iid = ii.closest('tr').cells[0].innerText;
        var iname = ii.closest('tr').cells[1].innerText;
        var iIMDb = ii.closest('tr').cells[4].innerText;
        $('#editid').val(iid);
        $('#editname').val(iname);
        $('#editIMDb').val(iIMDb);
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
                <button class="btn btn-success " data-bs-toggle='modal' data-bs-target='#add'>新增商品</button>
            </div>
            <table class="table table-striped text-break table-hover" id="itemtable">
                <thead>
                    <tr>
                        <th>itemId</th>
                        <th>品名</th>                        
                        <th>價格</th>
                        <th>位置</th>
                        <th>IMDb</th>
                        <th>操作</th>
                        
                    </tr>
                </thead>
                <tbody id="soldlist">
                    <?php foreach($items as $key => $item):?>
                        <tr>
                            <td><?php echo $item['ItemId'];?></td>
                            <td><?php echo $item['name'];?></td>
                            <td>$22.44</td>
                            <td><a href="<?php echo THISURL.'static/'.$item['src'];?>"><?php echo $item['src'];?></a></td>
                            <td><?php echo $item['IMDb'];?></td>
                            <td><button class="btn btn-warning" data-bs-toggle='modal' data-bs-target='#edit' onclick="fill(this)" >修改</button><button class="btn btn-danger " onclick="location.href='<?php echo THISURL."item/delitem/".$item['ItemId']; ?>'">刪除</button></td>
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
        <h5 class="modal-title" id="Label">新增商品</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        <form method='POST' action="<?php echo THISURL; ?>item/additem" id="newitemform" enctype='multipart/form-data'>
            <label for="name" class="form-label">name</label>
            <input type="text" class="form-control" name="name" >
            <label for="IMDb" class="form-label">IMDb</label>
            <input type="text" class="form-control" name="IMDb" >
            <label for="pic" class="form-label">pic</label>
            <input type='file' class="form-control" name="pic" >
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onclick="addsubmit()">確定</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Label">修改商品</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        <form method='POST' action="<?php echo THISURL; ?>item/edititem" id="edititemform" enctype='multipart/form-data'>
            <input id="editid" type="hidden" name="id">
            <label for="name" class="form-label">name</label>
            <input id="editname" type="text" class="form-control" name="name" >
            <label for="IMDb" class="form-label">IMDb</label>
            <input id="editIMDb" type="text" class="form-control" name="IMDb" >
            <label for="pic" class="form-label">pic</label>
            <input type='file' class="form-control" name="pic" >
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onclick="editsubmit()">確定</button>
      </div>
    </div>
  </div>
</div>

