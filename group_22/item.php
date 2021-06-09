<?php
$page = 0;
$log=0;
$rwd = 0;
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
include "recommend.php";
// if(isset($_POST['review']) and strcmp(trim($_POST['review']),"") != 0)
// {
//     if(isset($_SESSION['user_id']))
//     {
//         include "link.php";

//         $sql = "insert into reviews (pid,account,review) values ('$id','$_SESSION[user_id]','".nl2br(htmlentities($_POST['review']))."')";

//         if($result = mysqli_query($link,$sql))
//         {
//             echo "<script> window.location.href = 'item.php?item_id=$id&comment_s=1'; </script>";
//         }
//         mysqli_close($link);
//     }
//     else
//         header("location: login.php");
// }
// else if(isset($_POST['review']) and strcmp(trim($_POST['review']),"") == 0)
//     echo "<script> window.location.href = 'item.php?item_id=$id&comment_s=0'; </script>";

include "link.php";

$sql = "select *,DATE_FORMAT(reviews.date,'%x/%c/%d %H:%i') as df from reviews where pid='$id' order by date asc";
$page=(isset($_GET['page']))?$_GET['page']:0;
$reviews = array();
if($result = mysqli_query($link,$sql))
{
    // echo "123123";
    $c = 1;
    $total_num = mysqli_num_rows($result); //查詢結果筆數
    $total_page = ceil($total_num /10);
    while($row = mysqli_fetch_assoc($result))
    {
        $reviews[$c] = $row;
        $c++;
    }
        
    mysqli_free_result($result);
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

          
        $(document).ready(function(){

            var p=0,

                t=0,

                n=$("nav");

            $(window).scroll(function(){

                p=$(this).scrollTop();

                if(t<p&&n.is(':visible')){
                    n.stop().fadeOut(25);
                    //下滾
                }
                else if(t>p&&!n.is(':visible')){
                    n.stop().show();
                        //上滾            
                }
                t = p ;
                // setTimeout(function(){ t = p ; },0)
            })

        });
        
    </script>
    <style>
        img { height: 500px; background-color: white;}
        @media screen and (max-width:10000px){
            #mode1{
                display: block;
            }
            #mode2{
                display: none;
            }
            #mode3{
                display: none;
            }
        }
        @media screen and (max-width:991px){
            #mode1{
                display: none;
            }
            #mode2{
                display: block;
            }
            #mode3{
                display: block;
            }
        }
        @media screen and (max-width:767px){
            #mode1{
                
                display: block;
            }
            #mode2{
                display: none;
            }
            #mode3{
                display: none;
            }
        }
        @media screen and (max-width:250px){
            #mode1{
                display: none;
            }
            #mode2{
                display: block;
            }
            #mode3{
                display: block;
            }
        }         
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
            <div class="col-lg-8">
                <div class="card mt-4">
                    <img class="card-img-top img-fluser_id object-fit object-fit_scale-down"    src='<?php echo "images/".$content[$id]['file_name'] ; ?>' alt="no img">
                    <div class="card-body">
                        <h3 class="card-title">
                            <?php echo $content[$id]['name']; ?>
                        </h3>
                        <h2>
                           直購價: <?php echo  "<font color='red' style='bold'>$".$content[$id]['price']."&emsp;</font>"; ?>
                        評分:   
                        <span class="text-warning">
                            <?php
                            for($i = 0;$i < 5;$i++)
                                echo $i < ($content[$id]['star_count']==0?$content[$id]['star']:($content[$id]['star']/$content[$id]['star_count'])) ? "&#9733; ":"&#9734; ";
                            ?>
                        </span> 
                        <font size="3">(已有<?php echo $content[$id]['star_count']; ?>人評分)</font>
                        </h2>
                        
                        <h4>
                            <div class="row">
                                <div class='input-group col-lg-4'>
                                    數量:&ensp;
                                    <button class='btn btn-outline-secondary' name='bm' type='button'>-</button>
                                    <input type='text' class='form-control' name="num" id="num" value="1" style='text-align:center'>
                                    <button class='btn btn-outline-secondary' name='bp' type='button'>+</button>
                                </div>
                            </div>    
                        </h4>
                        <div id='intro'>
                        <h4>        
                                <!-- <div class='col-lg-6 offset-lg-1'> -->
                                    
                                        庫存:&ensp;<?php echo $content[$id]['stock']; ?>
                                    
                                <!-- </div> -->
                            
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
                        <!-- intro尾div -->
                        </div>
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
                    <div id="card-body" class="card-body">
                    <script>
                        var commentarr =[];
                        var page = 1;
                    </script>
                        <?php 
                            if(count($reviews)==0)
                                echo'<h4>尚無評論</h4>';
                            else{
                                foreach ($reviews as $review) {
                                    //     echo "<p>$review[review]</p>
                                    // <small class='text-muted'>張貼者:$review[account]<br>張貼時間:$review[df]</small>
                                    // <hr>";    
                                        echo "<script>commentarr.push({review:'$review[review]',account:'$review[account]',df:'$review[df]'});</script>";
                                }  
                            }      
                                // for($k=$page*10+1;$k<=$page*10+10 && $k<=$total_num;$k++)
                                // {
                                //     echo ;
                                // }                      
                            
                            // for($i=1;$i<=$total_page;$i++)
                            // {
                            //     if($page==$i)
                            //     {
                            //         echo "$i&nbsp;&nbsp;";
                            //     }else{
                            //         echo "<a href='".$_SERVER['PHP_SELF']."?page=$i'> $i </a>&nbsp;&nbsp;";
                            //     }
                            // }
                        ?>
                        <script>
                            var showcomment=function(){
                                document.getElementById("card-body").innerHTML="";
                                for(k=(page-1)*10;k<=(page-1)*10+9 && k<commentarr.length;k++)
                                {
                                    document.getElementById("card-body").innerHTML+="<p>"+commentarr[k]['review']+"</p><small class='text-muted'>張貼者:"+commentarr[k]['account']+"<br>張貼時間:"+commentarr[k]['df']+"</small><hr>"
                                }
                                showpage(); 
                            }

                            if(commentarr.length!=0)
                            {
                                showcomment();
                            }                          
                        </script>
                        <!-- <form action="" method="POST" id='form3' name='form3'>
                            <textarea class="form-control" name="review" id="review" rows="5" placeholder="在此輸入你的評論"></textarea><br>
                            <button class="btn btn-success" type="submit">留下評論</button>
                        </form> -->
                    </div>
                    <div id="pageindex" style="text-align:center">
                            
                    </div >
                    <script>
                        var showpage=function(){
                            document.getElementById("pageindex").innerHTML = "";
                            for(i=1;i<(commentarr.length/10)+1;i++)
                            {
                                if(i==page)
                                    document.getElementById("pageindex").innerHTML+= i+"&nbsp;&nbsp;";
                                else
                                    document.getElementById("pageindex").innerHTML+="<a href=javascript:(function(){page="+i+";showcomment();})();>"+i+"&nbsp;&nbsp;"+"</a>";
                            }
                        }
                        if(commentarr.length!=0)
                            showpage();
                    </script>
                </div>
            </div>
            <?php
                    echo '
                    <div id="mode1" class="col-md-4">
                        <div class="card mt-4">
                            <div class="card-header text-center">
                            👇你可能會喜歡 👇
                            <a href="item.php?item_id='.$commend[$choo[0]]['pid'].' ">
                            <img class="card-img-top img-fluser_id object-fit object-fit_scale-down" 
                            src="images/'.$commend[$choo[0]]['file_name'].'">
                            </a>
                            </div>
                            <div class="card-body text-center">
                            <a href="item.php?item_id='.$commend[$choo[0]]['pid'].' ">
                            '.$commend[$choo[0]]['name'].'
                            </a>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-header text-center">
                            👇你可能會喜歡 👇
                            <a href="item.php?item_id='.$commend[$choo[1]]['pid'].' ">
                            <img class="card-img-top img-fluser_id object-fit object-fit_scale-down" 
                            src="images/'.$commend[$choo[1]]['file_name'].'">
                            </a>
                            </div>
                            <div class="card-body text-center">
                            <a href="item.php?item_id='.$commend[$choo[1]]['pid'].' ">
                            '.$commend[$choo[1]]['name'].'
                            </a>
                            </div>
                        </div>
                    </div>
                    
                    ';
                    echo '
                    <div id="mode2" class="col-md-6">
                        <div class="card mt-4">
                            <div class="card-header text-center">
                            👇你可能會喜歡 👇
                            <a href="item.php?item_id='.$commend[$choo[0]]['pid'].' ">
                            <img class="card-img-top img-fluser_id object-fit object-fit_scale-down" 
                            src="images/'.$commend[$choo[0]]['file_name'].'">
                            </a>
                            </div>
                            <div class="card-body text-center">
                            <a href="item.php?item_id='.$commend[$choo[0]]['pid'].' ">
                            '.$commend[$choo[0]]['name'].'
                            </a>
                            </div>
                        </div>
                    </div>
                    <div id="mode3" class="col-md-6">
                        <div class="card mt-4">
                            <div class="card-header text-center">
                            👇你可能會喜歡 👇
                            <a href="item.php?item_id='.$commend[$choo[1]]['pid'].' ">
                            <img class="card-img-top img-fluser_id object-fit object-fit_scale-down" 
                            src="images/'.$commend[$choo[1]]['file_name'].'">
                            </a>
                            </div>
                            <div class="card-body text-center">
                            <a href="item.php?item_id='.$commend[$choo[1]]['pid'].' ">
                            '.$commend[$choo[1]]['name'].'
                            </a>
                            </div>
                        </div>
                    </div>
                    
                    ';
                
            ?>
            
                
        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>