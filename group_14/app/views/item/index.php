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
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach($items as $item):?>
                    <div class="col">
                        <div class="card h-100">
                            <img src='<?php echo $thisurl.'static/'.$item['src'];?>' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item['name'];?></h5>
                                <h5 class="card-title">$22.44</h5>
                                <p class="card-text"><a href="<?php echo $thisurl;?>item/detail/<?php echo $item['ItemId'] ?>".>detail</a></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </main>
    </div>
</div>