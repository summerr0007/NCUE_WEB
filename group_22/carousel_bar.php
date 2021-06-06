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
<!-- <div class="col-lg-12"> -->
<div style = "margin-top:30px"></div>
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
<!-- </div> -->