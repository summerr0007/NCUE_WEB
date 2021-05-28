<div class="container-xxl">
    <div class="row">
        <aside class="col-3 border border-primary">
            <nav>
                <ui>
                    <?php foreach($items as $item):?>
                        <li><?php echo $item['name'];?></li>
                    <?php endforeach ?>
                </ui>
            </nav>
        </aside>
        <main class="col-9" >
            <div class="row align-items-start">
                <?php foreach($items as $item):?>
                    <div class="col-3 border border-success gx-5">
                        <img class= "rounded mx-auto d-block" src='<?php echo $thisurl.'static/'.$item['src'];?>'>
                        <p class ="text-center" ><?php echo $item['name'];?><br></p>
                        <p class ="text-center" >$22.44<p>
                        <p class ="text-center" ><a href="item/detail/<?php echo $item['id'] ?>".>detail</a></p>
                    </div>
                <?php endforeach ?>
            </div>
        </main>
    </div>
</div>