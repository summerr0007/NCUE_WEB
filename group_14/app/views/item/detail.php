<div class="container-xxl">
    <div class="row">
        <main class="col" >
            <img class= "rounded mx-auto d-block" src='<?php echo $thisurl.'static/'.$item['src'];?>'>
            <p class ="text-center" ><?php echo $item['name'];?><br></p>
            <p class ="text-center" >$22.44</p>
            <p class ="text-center" ><button id="addcar" type="button" class="btn btn-success btn-lg" onclick="addcar()">加入購物車</button><button id="addcar" type="button" class="btn btn-danger btn-lg" onclick="">立刻觀看</button></p>
        </main>
    </div>
    <div id="watch">
    </div>
</div>
<script>
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