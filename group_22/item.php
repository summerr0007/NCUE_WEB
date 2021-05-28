<?php
$page = 0;
$log=0;
session_start();
if(isset($_SESSION['user_id']))
{
    $log=1;
}
if(isset($_SESSION['in_cart']))
    $in_cart = $_SESSION['in_cart'];
else
    $in_cart = array();
if(isset($_GET['item_id']))
    $id = $_GET['item_id'];
else
    header('location: index.php');
include "content.php";
if(isset($_POST['review']) and strcmp(trim($_POST['review']),"") != 0)
{
    if(isset($_SESSION['user_id']))
    {
        include "link.php";

        $sql = "insert into reviews (pid,account,review) values ('$id','$_SESSION[user_id]','".nl2br(htmlentities($_POST['review']))."')";

        if($result = mysqli_query($link,$sql))
        {
            echo "<script> window.location.href = 'item.php?item_id=$id&comment_s=1'; </script>";
        }
        mysqli_close($link);
    }
    else
        header("location: login.php");
}
else if(isset($_POST['review']) and strcmp(trim($_POST['review']),"") == 0)
    echo "<script> window.location.href = 'item.php?item_id=$id&comment_s=0'; </script>";

include "link.php";

$sql = "select *,DATE_FORMAT(reviews.date,'%x/%c/%d %H:%i') as df from reviews where pid='$id' order by date asc";

$reviews = array();
if($result = mysqli_query($link,$sql))
{
    // echo "123123";
    while($row = mysqli_fetch_assoc($result))
        $reviews[] = $row;
    mysqli_free_result($result);
}

$user_have = false;
if(isset($_SESSION['user_id']))
{
    $sql = "select * from buyed_book where account='$_SESSION[user_id]' and pid='$id'";
    if($result = mysqli_query($link,$sql))
    {
        if($row = mysqli_fetch_assoc($result))
            $user_have = true;
        else
            $user_have = false;
        mysqli_free_result($result);
    }
}

//查看庫存是否以空
$now_stock = 0;
$sql = "select stock from commodity where pid = '$id'";
if ($result = mysqli_query($link, $sql)) {
$row = mysqli_fetch_assoc($result);
$now_stock=$row["stock"];
mysqli_free_result($result); // 釋放佔用的記憶體
}

mysqli_close($link);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>
        <?php echo $content[$id]['name']; ?>
    </title>
    <!-- Bootstrap core CSS -->
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="js/in_cart.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/style.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <script>
        $(function(){
            $("[name='bp']").click(function(){
                $temp=parseInt($('input[name="num"]').val());
                $max=parseInt(<?php echo $content[$id]['stock']?>);
                if($max>$temp)
                {
                    $temp=$temp+1;
                    $('input[name="num"]').val($temp); 
                }               
            });
            $("[name='bm']").click(function(){
                $temp=parseInt($('input[name="num"]').val());
                if(1<$temp)
                {
                    $temp=$temp-1;
                    $('input[name="num"]').val($temp); 
                }               
            });
            $('input[name="num"]').change(function(){
                $temp=parseInt($('input[name="num"]').val());
                $max=parseInt(<?php echo $content[$id]['stock']?>);
                if($max<$temp)
                {
                    $('input[name="num"]').val($max); 
                }
                if(1>$temp)
                {
                    $('input[name="num"]').val("1"); 
                }               
            });
        });

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
    <style>
        img { height: 500px; background-color: white;}
    </style>
</head>

<body <?php if(isset($_GET['comment_s'])&&$_GET['comment_s']==1){ echo'onload="Swal.fire({';
		echo"	icon: 'success',";
		echo"	title: '留言成功!',";
		echo'	showConfirmButton: false,
				timer: 800
			}).then(() => {';
		echo"			window.location.href = 'item.php?item_id=$id';";
		echo'		    })"';} 
        else if(isset($_GET['comment_s'])&&$_GET['comment_s']==0){ echo'onload="Swal.fire({';
            echo"	icon: 'error',";
            echo"	title: '未輸入有效留言!',";
            echo'	showConfirmButton: false,
                    timer: 800
                }).then(() => {';
            echo"			window.location.href = 'item.php?item_id=$id';";
            echo'		    })"';}?>>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="card mt-4">
                    <img class="card-img-top img-fluser_id object-fit object-fit_scale-down"    src='<?php echo "images/p_".($id > 30 ? "30":$id).".jpg "; ?>' alt="no img">
                    <div class="card-body">
                        <h3 class="card-title">
                            <?php echo $content[$id]['name']; ?>
                        </h3>
                        <h2>
                           直購價: <?php echo  "<font color='red' style='bold'>$".$content[$id]['price']."</font>"; ?>
                        <span class="text-warning">
                            <?php
                            for($i = 0;$i < 5;$i++)
                                echo $i < $content[$id]['star'] ? "&#9733; ":"&#9734; ";
                            ?>
                        </span>
                        <?php echo $content[$id]['star']; ?> 顆星    
                        </h2>
                        <h4>
                            
                            <!-- <div class="input-group">
                                數量:&ensp;
                                <input type="button" name='bm' value='-'>
                                <input type="text" name="num" id="num" value="1" size="5px" style="text-align:center">
                                <input type="button" name='bp'value='+'>
                                &emsp;庫存:
                                <?php echo $content[$id]['stock']; ?> 
                            </div> -->
                            <div class="row">
                                <div class='input-group col-lg-4'>
                                    數量:&ensp;
                                    <button class='btn btn-outline-secondary' name='bm' type='button'>-</button>
                                    <input type='text' class='form-control' name="num" id="num" value="1" style='text-align:center'>
                                    <button class='btn btn-outline-secondary' name='bp' type='button'>+</button>
                                </div>
                                <div class='col-lg-6 offset-lg-1'>
                                    庫存:&ensp;<?php echo $content[$id]['stock']; ?> 
                                </div>
                            </div>
                        </h4> 
                        <h3>
                            <button class="btn btn-<?php echo ($now_stock==0) ? "secondary":"primary"; ?>" onClick="is_add(
                                <?php echo $id; ?>,  document.getElementById('num').value,<?php echo $log; ?>,0)"
                                <?php if($now_stock==0) echo 'disabled="disabled"'; ?>type="button">
                                <i class="fa fa-cart-plus fa-lg"></i>
                                <?php
                            echo ($now_stock==0) ? "尚無庫存": "加入購物車" ;
                            ?>
                            </button>
                            <button class="btn btn-<?php echo ($now_stock==0) ? "secondary":"danger"; ?>" onClick="is_add(
                                <?php echo $id; ?>,  document.getElementById('num').value,<?php echo $log; ?>,1)"
                                <?php if($now_stock==0) echo 'disabled="disabled"'; ?>type="button">
                                
                                <?php
                            echo ($now_stock==0) ? "尚無庫存": "直接購買" ;
                            ?>
                            </button>                            
                        </h3>
                        <p class="card-text">
                            <?php echo $content[$id]['summary']; ?>
                        </p>
                        <p class="card-text">
                            作者:
                            <?php echo $content[$id]['author']; ?> &nbsp;
                            出版社:
                            <?php echo $content[$id]['publisher']; ?> &nbsp;
                            發行日期:
                            <?php echo $content[$id]['date']; ?>
                        </p>
                    </div>
                </div>
                <div class="card card-outline-secondary my-4">
                <!-- 留言區 -->
                    <div class="card-header">
                        <font color="red" style="bold">書籍評論</font>
                    </div>
                    <div class="card-body">
                        <?php 
                        foreach ($reviews as $review) {
                            echo "<p>$review[review]</p>
                        <small class='text-muted'>張貼者:$review[account]<br>張貼時間:$review[df]</small>
                        <hr>";
                        }
                        ?>
                        <form action="" method="POST" id='form3' name='form3'>
                            <textarea class="form-control" name="review" id="review" rows="5" placeholder="在此輸入你的評論"></textarea><br>
                            <button class="btn btn-success" type="submit">留下評論</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>