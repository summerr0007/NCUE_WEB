<div class="container-xxl">
    <div class="row">
        <main class="col" >
            <img class= "rounded mx-auto d-block" src='<?php echo $thisurl.'static/'.$item['src'];?>'>
            <p class ="text-center" ><?php echo $item['name'];?><br></p>
            <p class ="text-center" >$22.44</p>
            <p class ="text-center" ><button id="addcar" type="button" class="btn btn-success btn-lg" onclick="addcar()">加入購物車</button><button id="addcar" type="button" class="btn btn-danger btn-lg ms-3" onclick="watch()">立刻觀看</button></p>
        </main>
    </div>
    <div id="IMDb" class="row">
        <div class="col">
            <button type="button" class="btn btn-primary" onclick="location.href='<?php echo $item['IMDb'] ?>'" >IMDb</button>
        </div>        
    </div>
    
    <div class="row">
        <h3>評論區</h3>
        <div class="col" id="comment">

        </div> 
        <div class="card">
            <div class="card-header">
                說點什麼
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                <textarea id="addcomment"><?php echo empty($loginid)?"請先登入":"" ; ?></textarea>
                </blockquote>
                <button class="btn btn-primary" onclick="add()" <?php echo empty($loginid)?"disabled=''":"" ; ?>>發布</button>
            </div>
        </div>       
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        尚未購買，是否加入購物車
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">否</button>
        <button type="button" class="btn btn-success" onclick="addcar()" data-bs-dismiss="modal"> 是</button>
      </div>
    </div>
  </div>
</div>



<script>
    var myModal = new bootstrap.Modal(document.getElementById('myModal'));
    var addcar = function(){
        $.ajax({
            type: 'POST',
            url: '<?php echo THISURL.'shopcar/addcar/'.$id ;?>',
            datatype: "json",
            async: true,
            success: function(data) {                  
                alert(data);                
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }
</script>

<script>
    var watch = function(){
        $.ajax({
            type: 'POST',
            url: '<?php echo THISURL.'sold/watchnow/'.$id ;?>',
            datatype: "json",
            async: true,
            success: function(data) {                  
                if(data == -1){
                    alert("請先登入");
                }else if(data == 0){
                    myModal.show();
                }else if(data == 1){
                    alert("沒有電影但有Rick");
                    location.href = "https://youtu.be/dQw4w9WgXcQ";
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }


    var showbody = function(data) {
        let comment = document.getElementById("comment");
        
        comment.innerHTML = "";
        var print = function(element, index, array) {
            comment.innerHTML += `
                <div class="card">
                    <div class="card-header">
                        ${element['account']}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p>${element['Comment']}</p>
                        </blockquote>
                    </div>
                </div>
            `;
        }
        if(data === null || data.length ==0){
            comment.innerHTML=`
                <div class="card">
                    <div class="card-header">
                        空
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                        <p>沒有評論</p>
                        </blockquote>
                    </div>
                </div>
            `;
            checkout.setAttribute("disabled","");
        }else{
            data.forEach(print);
        }
        
    }


    var show = function() {
        $.ajax({
            type: 'POST',
            url: `<?php echo THISURL; ?>comment/show/<?php echo $id;?>`,
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }
    show();

    var add = function() {
        $.ajax({
            type: 'POST',
            url: `<?php echo THISURL; ?>comment/add/`,
            data: "itemid=<?php echo $id;?>&memberid=<?php echo $loginid;?>&comment="+$("#addcomment").val(),
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
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR);
            }
        });
    }


</script>

