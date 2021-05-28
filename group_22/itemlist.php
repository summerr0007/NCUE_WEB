<?php
    $page = 0;
    session_start();
    if(isset($_GET['index']))
        $index = intval($_GET['index']);
    else
        $index = 0;

    if(isset($_GET['species']))
    {
        $_SESSION['species'] = $_GET['species'];
        if(isset($_SESSION['key']))
            unset($_SESSION['key']);
    }
    if(isset($_POST['key']))
    {
    $_SESSION['key'] = $_POST['key'];
    if(isset($_SESSION['species']))
        unset($_SESSION['species']);
    }

    include "link.php";

    $cause_error = false;
    $msg = "";
    $contents = array();
    if(isset($_SESSION['key']))
    {
        $key = $_SESSION['key'];
        if(trim($key)!="")
        {
            $sql = "select * from commodity where name like '%$key%' or summary like '%$key%'";
            if($result = mysqli_query($link,$sql))
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    $contents[]=$row;
                }
                mysqli_free_result($result);
            }
        }
        else
        {
            $cause_error = true;
            $msg = "您並未輸入任何字，請輸入字後再搜尋一遍!";
        }
    }
    else if(isset($_SESSION['species']))
    {
        $sql = "select * from commodity where cate = '$_SESSION[species]'";
        if($result = mysqli_query($link,$sql))
        {
            while($row = mysqli_fetch_assoc($result))
            {
                $contents[] = $row;
            }
            mysqli_free_result($result);
        }
    }
    else header("location : index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>商品清單</title>
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">
    <script src="js/in_cart.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>    
    <link rel="stylesheet" href="css/style.css">
    <script> 
        var top1 = 0;
        $(document).ready(function(){
            const $ScrollWrap = $("#scroll-wrap")
            // 监听滚动停止
            let t1 = 0;
            let t2 = 0;
            let timer = null; // 定時器
            $(window).on("touchstart", function(){
                // 觸控開始
            })
            $(window).on("scroll", function(){
                // 滾動
                clearTimeout(timer)
                timer = setTimeout(isScrollEnd, 100)
                t1 = $(this).scrollTop()
            })
            function isScrollEnd() {
                t2 = $(window).scrollTop();
                if(t2 == t1){
                    if(t2>top1)
                    {
                        top1=t2;
                        $("nav").slideUp();
                    }
                    else if(t2<top1)
                    {
                        top1=t2;
                        $("nav").slideDown();
                    }
                    clearTimeout(timer)
                }
            }
        })
    </script>    
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="row">
            <?php include "left_side_bar.php"; ?>
            <div class="col-lg-10">
                <div style = "margin-top:30px"></div>
                <div class="row">
                    <?php
                    if($cause_error)
                        echo '<div class="col" style="color:#D68B00;text-align:center;"><h2>'.$msg.'</h2></div>';
                    else if(count($contents) == 0)
                        echo '<div class="col" style="color:#D68B00;text-align:center;"><h2>找不到結果</h2></div>';
                    else
                    {
                        $i = 0;
                        foreach($contents as $value) {
                            if($i < $index*6){ $i++; continue;}
                            if($i >= min(array($index*6+6,count($contents)))) break;
                            echo '
                        <div class="col-lg-4 col-md-6 mb-4 px-4">
                            <div class="card h-100">
                                <a href="item.php?item_id='.$value['pid'].'"><img class="card-img-top object-fit object-fit_scale-down" src="images/p_'.($value['pid'] > 30 ? "30":$value['pid']).'.jpg" alt="no img"></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="item.php?item_id='.$value['pid'].'">'.$value['name'].'</a>
                                    </h4>
                                    <h5>$'.$value['price'].'</h5>

                                </div>
                                <div class="card-footer">
                                <small class="text-muted">';
                        for($j = 0;$j < 5;$j++)
                            echo $j < $value['star'] ? "&#9733; ":"&#9734; ";
                        echo '</small>
                            </div>
                            </div>
                        </div>
                    ';
                        $i++;
                        }
                    }
                ?>
                </div>
                <div class="row">
                    <?php
                        if($index != 0) echo '<a href="?index='.($index-1).'"><button class="btn btn-primary">
                        上一頁
                    </button></a>';
                        if(($index+1)*6 < count($contents)) echo '&emsp;<a href="?index='.($index+1).'"><button class="btn btn-primary">
                        下一頁
                    </button></a>';
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>