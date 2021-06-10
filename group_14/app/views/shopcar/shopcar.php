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

<div class="container-xxl">
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>品名</th>
                    <th>總價</th>
                    <th>授權</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody id="carbody">

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="1"> <input id="checkout" type="button" class="btn btn-success btn-lg" value="結帳" data-bs-toggle="modal" data-bs-target="#check"> </td>
                    <td colspan="1"> <input id="clean" type="button" class="btn btn-danger btn-lg" value="清空購物車" onclick="clean()"> </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="check" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Label">結帳</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        你確定要結帳嗎
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
        <button type="button" class="btn btn-primary" onclick="location.href='<?php echo THISURL."sold/checkup" ;?>'">確定</button>
      </div>
    </div>
  </div>
</div>


<script>
    var js = <?php echo $itemsInCar; ?>;
    var showbody = function(data) {
        let carbody = document.getElementById("carbody");
        let checkout = document.getElementById("checkout");
        carbody.innerHTML = "";
        var print = function(element, index, array) {
            carbody.innerHTML += `
            <tr>
                <td>${index}</td>
                <td>${element['name']}</td>
                <td>22.22</td>
                <td>終生授權</td>
                <td><button type="button" class="btn btn-danger" onclick="remove(${element['ShopcarId']})">刪除</button></td>
            </tr>
            `;
        }
        if(data === null || data.length ==0){
            carbody.innerHTML=`
                <tr>
                    <td colspan=6>空空如也</td>
                </tr>
            `;
            checkout.setAttribute("disabled","");
        }else{
            data.forEach(print);
        }
        
    }
    showbody(js);

    var remove = function(ShopcarID) {
        $.ajax({
            type: 'POST',
            url: `<?php echo THISURL; ?>shopcar/remove/${ShopcarID}`,
            datatype: "json",
            async: true,
            success: function(data) {
                  
                if(data!=""){
                    console.log(typeof(data));                   
                    data = data.slice(0, -2); 
                    console.log(data); 
                    let tarr = data.split(',,');
                    let map1 = tarr.map(x => JSON.parse(x));
                    showbody(map1);
                }else{
                    showbody(null);
                }
                alert("成功刪除");                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }

    var clean = function(ShopcarID) {
        $.ajax({
            type: 'POST',
            url: `<?php echo THISURL; ?>shopcar/clean/`,
            datatype: "json",
            async: true,
            success: function(data) {
                  
                if(data!=""){
                    console.log(typeof(data));                   
                    data = data.slice(0, -2); 
                    console.log(data); 
                    let tarr = data.split(',,');
                    let map1 = tarr.map(x => JSON.parse(x));
                    showbody(map1);
                }else{
                    showbody(null);
                }
                alert("成功刪除");                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }
</script>