<?php
    include "link.php";
    
    $sql = "select * from mycarousel";/*表單名子 */
    
    $cc = array();
    if($result = mysqli_query($link,$sql))
    {
        while($row = mysqli_fetch_assoc($result))
            $cc[$row['cid']] = $row;
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
<div class="col-lg-12">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100"  src='./images/<?php echo$cc['1']['pic']; ?>' alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                     <h5><?php echo$cc['1']['ptitle']; ?></h5>
                    <p><?php echo$cc['1']['ptext']; ?></p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/<?php echo$cc['2']['pic']; ?>" alt="Second slide">
                <div class="carousel-caption d-none d-md-block" >
                     <h5><?php echo$cc['2']['ptitle']; ?></h5>
                    <p><?php echo$cc['2']['ptext']; ?></p>
                </div>                
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="./images/<?php echo$cc['3']['pic']; ?>" alt="Third slide">
                <div class="carousel-caption d-none d-md-block">
                     <h5><?php echo$cc['3']['ptitle']; ?></h5>
                    <p><?php echo$cc['3']['ptext']; ?></p>
                </div>            
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class=" col-lg-2 ">
    <div style = "margin-top:30px"></div>
    <div class="list-group">
        <li class="list-group-item text-white" style="background-image: linear-gradient(to top, #09203f 0%, #537895 100%);">商品分類</li>
        <a href="itemlist.php?species=輕小說" class="list-group-item list-group-item-action
        <?php
            if(isset($_GET['species'])&&$_GET['species']=="輕小說")
                echo"disabled";  
        ?>"
        <?php
            if(isset($_GET['species'])&&$_GET['species']=="輕小說")
                echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";  
        ?>>輕小說</a>
        <a href="itemlist.php?species=考試用書" class="list-group-item list-group-item-action
        <?php
            if(isset($_GET['species'])&&$_GET['species']=="考試用書")
                echo"disabled";  
        ?>"
        <?php
            if(isset($_GET['species'])&&$_GET['species']=="考試用書")
                echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";  
        ?>>考試用書</a>
        <a href="itemlist.php?species=飲食" class="list-group-item list-group-item-action
        <?php
            if(isset($_GET['species'])&&$_GET['species']=="飲食")
                echo"disabled";  
        ?>"
        <?php
            if(isset($_GET['species'])&&$_GET['species']=="飲食")
                echo"style='background-image: linear-gradient(to right, #dfe9f3 0%, white 100%);'";  
        ?>>飲食</a>
    </div>
</div>