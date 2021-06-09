<div class="container-xxl">
    <div class="row">
        <aside class="col-3 border border-primary">
            <ui class='nav nav-pills flex-column mb-auto'>
                <?php foreach($items as $item):?>
                <li class="nav-item"><a href="<?php echo THISURL."item/detail/".$item['ItemId'];?>"><?php echo $item['name'];?></a></li>
                <?php endforeach ?>
            </ui>
        </aside>
        <main class="col-9" >
            <div class="row align-items-start">
                <?php foreach($items as $item):?>
                    <div class="col-3 border border-success d-flex flex-wrap flex-column justify-content-center">
                        <img class= "rounded mx-auto d-block d-flex flex-column" src='<?php echo $thisurl.'static/'.$item['src'];?>'>
                        <div class =" d-flex justify-content-center " ><?php echo $item['name'];?></div>
                        <div class =" d-flex justify-content-center " >$22.44</div>
                        <div class =" d-flex  justify-content-center" ><a href="<?php echo $thisurl;?>item/detail/<?php echo $item['ItemId'] ?>".>detail</a></div>
                    </div>
                <?php endforeach ?>
            </div>
        </main>
    </div>
</div>