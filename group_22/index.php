<?php
$page = 1;
$log=0;
$index=0;
session_start();
if(isset($_SESSION['user_id']))
{
    $log=1;
}
if(isset($_GET['index_search']))
    $index_search = intval($_GET['index_search']);
else
    $index_search = 0;
if(isset($_GET['sort_search']))
    $_SESSION['sort_search'] = $_GET['sort_search'];
if(isset($_POST['key']))
{
    $_SESSION['key'] = $_POST['key'];//用session可讓搜尋結果繼續按下一頁
    $_SESSION['sort_search'] = 1;
}
    
if(isset($_SESSION['key'])||isset($_SESSION['sort_search']))
{
    // echo'alert("'.$_SESSION['key'].'")';
    include "link.php";

    $cause_error = false;
    $msg = "";
    $contents = array();
    $key = $_SESSION['key'];
    if(trim($key)!="")
    {
        if(isset($_SESSION['sort_search']))
            switch($_SESSION['sort_search'])
            {
                case 1:$sql = "select * from commodity where name like '%$key%' or summary like '%$key%'"; break;
                case 2:$sql = "select * from commodity where name like '%$key%' or summary like '%$key%' order by price"; break;
                case 3:$sql = "select * from commodity where name like '%$key%' or summary like '%$key%' order by price desc"; break;
                default:$sql = "select * from commodity where name like '%$key%' or summary like '%$key%'";
            }
        else
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
    <script src="//jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_zh_TW.js "></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    

    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>窩是書店</title>
    <!-- <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
    <script src="js/in_cart.js"></script>
    <script src="./vendor/fly/dist/jquery.fly.min.js"></script>
    <!-- <script src="https://unpkg.com/headroom.js@0.12.0/dist/headroom.js"></script>
    <script src="https://unpkg.com/headroom.js@0.12.0/dist/headroom.min.js"></script> -->
    <script> 
        // var top1 = 0;
        // $(document).ready(function(){
        //     let t1 = 0;
        //     let t2 = 0;
        //     let timer = null; // 定時器
        //     // $(window).on("touchstart", function(){
        //     //     // 觸控開始
        //     // })
        //     $(window).on("scroll", function(){
        //         // 滾動
        //         clearTimeout(timer)
                
        //         timer = setTimeout(isScrollEnd, 50)
        //         t1 = $(this).scrollTop()
        //     })
        //     function isScrollEnd() {
        //         t2 = $(window).scrollTop();
        //         if(t2 == t1){
        //             if(t2>top1)
        //             {
        //                 top1=t2;
        //                 $("nav").slideUp(300);
        //             }
        //             else if(t2<top1)
        //             {
        //                 top1=t2;
        //                 $("nav").slideDown(200);
        //             }
        //             clearTimeout(timer)
        //         }
        //     }
        // })
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

        })
    </script>
    <script>
        function cart(id,wlog,index,sort) {
            $.ajax({
                url: 'itemlist_ajax.php',
                data: {
                    id: id,
                    wlog:wlog,
                    index:index,
                    sort:sort
                },
                type: 'POST',
                // dataType: "json",
                success: function(data) {
                    $("#search_area").html("");
                    if(id=="home")
                        $("#home").html(data);
                    else
                    {
                        $("#home").html("");
                        if(id=="輕小說")
                            $("#novel").html(data);
                        if(id=="考試用書")
                            $("#test").html(data);
                        if(id=="飲食")
                            $("#eat").html(data);
                    }          
            },
            error: function(xhr, ajaxOptions, thrownError) {}
        });
    }
    </script>   
</head>
<body <?php if(isset($_GET['log_out'])){ echo'onload="Swal.fire({';
        echo"position: 'top',";
		echo"	icon: 'success',";
		echo"	title: '登出成功!',";
		echo'	showConfirmButton: false,';
        echo"  backdrop: `
        rgba(250,228,147,0.4)";
        echo"url('./images/detective_small.gif')";
        echo"right bottom
        no-repeat
        `
			}).then(() => {";
		echo"			window.location.href = 'index.php';";
		echo'		    })"';} 
        else if(isset($_GET['login_s'])&&$_GET['login_s']==1&&isset($_SESSION['user_id'])){ echo'onload="Swal.fire({';
            echo"position: 'top',";
            echo"	icon: 'success',";
            echo"	title:'";echo $_SESSION['user_id'];echo "，歡迎回來!',";
            echo"   text: '疫情期間，出門請記得配戴口罩:)',";
            echo'	showConfirmButton: false,';
            echo"  backdrop: `
            rgba(172,194,254,0.4)";
            echo"url('./images/rabbit_small.gif')";
            echo"right bottom
            no-repeat
          `
            
                }).then(() => {";
            echo"			window.location.href = 'index.php';";
            echo'		    })"';}?>>
    <!-- header 最上面那一列-->
    <?php include "header.php"; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php include "carousel_bar.php"; ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div style = "margin-top:30px"></div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link <?php if(!isset($_POST['key'])&&!isset($_GET['index_search'])) echo'active'; ?>" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true" onclick="cart('home',<?php echo $log.','.$index;?>,1)">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="novel-tab" data-toggle="tab" href="#novel" role="tab" aria-controls="novel" aria-selected="false" onclick="cart('輕小說',<?php echo $log.','.$index;?>,1)">輕小說</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" id="test-tab" data-toggle="tab" href="#test" role="tab" aria-controls="test" aria-selected="false" onclick="cart('考試用書',<?php echo $log.','.$index;?>,1)">考試用書</a>
                    </li>                    

                    <li class="nav-item">
                        <a class="nav-link" id="eat-tab" data-toggle="tab" href="#eat" role="tab" aria-controls="eat" aria-selected="false" onclick="cart('飲食',<?php echo $log.','.$index;?>,1)">飲食</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade<?php if(!isset($_POST['key'])&&!isset($_GET['index_search'])) echo'show active'; ?>" id="home" role="tabpanel" aria-labelledby="home-tab" >
                            <?php
                                include "content.php";
                                echo '<div style = "margin-top:10px"></div>';
                                echo ' 
                                <div class="container">
                                    <div class="row justify-content-end">
                                        <div class="dropdown ">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-display="static" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
                                            background-blend-mode: multiply,multiply;">
                                            排序
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton" style="background: rgba(0,0,0,0.4); ">
                                            <a class="dropdown-item text-white" href="#" onclick="cart('."'".'home'."'".','.$log.',0,1)">預設</a>
                                            <a class="dropdown-item text-white" href="#" onclick="cart('."'".'home'."'".','.$log.',0,2)">價格低優先</a>
                                            <a class="dropdown-item text-white" href="#" onclick="cart('."'".'home'."'".','.$log.',0,3)">價格高優先</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                ';
                                echo '<div style = "margin-top:10px"></div>';
                                echo'<div class="row">';
                                if(!isset($_POST['key'])&&!isset($_GET['index_search'])){
                                    $i = 0;
                                    foreach($content as $value) //content來自  content.php
                                    {
                                        if($i<$index*6)
                                        { 
                                            $i++; 
                                            continue;
                                        }
                                        if($i >= min(array($index*6+6,count($content)))) 
                                            break;
                                        echo '
                                    
                                    <div class="col-lg-4 col-md-6 mb-4 px-4">
                                    
                                        <div class="card"style="height: 100%;" >
                                            <a href="item.php?item_id='.$value['pid'].'"><img class="card-img-top object-fit object-fit_scale-down"  src="images/p_'.($value['pid'] > 30 ? "30":$value['pid']).'.jpg" alt="no img"></a>
                                            <div class="card-body ">
                                                <h4 class="card-title">
                                                    <a style="display : inline-block; text-overflow : ellipsis; overflow: hidden; white-space : nowrap; width : 100%;" href="item.php?item_id='.$value['pid'].'">'.$value['name'].'</a>
                                                </h4>
                                                <h5>$'.$value['price'].'</h5>
                                                
                                            </div>
                                            <div class="card-footer">
                                            <small class="text-muted"><div class="row"><div class="col-6">';
                                        for($j = 0;$j < 5;$j++)
                                            echo $j < ($value['star_count']==0?$value['star']:$value['star']/$value['star_count']) ? "&#9733; ":"&#9734; ";echo'</div><div class="col-2 offset-4"><div id="'.$value['pid'].'">';
                                            if($value['stock']>0)
                                                echo'<i class="fa fa-cart-plus fa-lg" onclick="nav_slide('.$log.');cart_1('.$value['pid'].','.$log.')"></i>';
                                            else{echo'<i class="fas fa-times-circle"></i>';}    
                                                echo'</div></div>
                                                </div></small>
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
                                if($index != 0) echo '&emsp;<button class="btn btn-primary" onclick="cart('."'home'".','.$log.','.($index-1).',1)">
                                上一頁
                                </button>';
                                if(($index+1)*6 < count($content)) echo '&emsp;<button class="btn btn-primary" onclick="cart('."'home'".','.$log.','.($index+1).',1)">
                                下一頁
                                </button>';
                            ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="test" role="tabpanel" aria-labelledby="test-tab" ></div>
                    <div class="tab-pane fade" id="novel" role="tabpanel" aria-labelledby="novel-tab" ></div>
                    <div class="tab-pane fade" id="eat" role="tabpanel" aria-labelledby="eat-tab"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
        <div class="col-lg-12"> 
            <div id="search_area">
            <?php
                if(isset($_POST['key'])||isset($_GET['index_search']))
                {
                    echo '<div style = "margin-top:10px"></div>';
                    echo ' 
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="dropdown ">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-display="static" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
                                background-blend-mode: multiply,multiply;">
                                排序
                                </button>
                                <div class="dropdown-menu dropdown-menu-right " aria-labelledby="dropdownMenuButton" style="background: rgba(0,0,0,0.4);  ">
                                <a class="dropdown-item text-white" href="?sort_search=1&index_search='.$index_search.'">預設</a>
                                <a class="dropdown-item text-white" href="?sort_search=2&index_search='.$index_search.'">價格低優先</a>
                                <a class="dropdown-item text-white" href="?sort_search=3&index_search='.$index_search.'">價格高優先</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                    echo '<div style = "margin-top:10px"></div>';
                    echo'<div class="row">';
                    if($cause_error)
                        echo '<div class="col" style="color:#D68B00;text-align:center;"><h2>'.$msg.'</h2></div>';
                    else if(count($contents) == 0)
                        echo '<div class="col" style="color:#D68B00;text-align:center;"><h2>找不到結果</h2></div>';
                    else
                    {
                        $i = 0;
                        foreach($contents as $value) {
                            if($i < $index_search*6){ $i++; continue;}
                            if($i >= min(array($index_search*6+6,count($contents)))) break;
                            echo '
                        <div class="col-lg-4 col-md-6 mb-4 px-4">
                            <div class="card" style="height: 100%;">
                                <a href="item.php?item_id='.$value['pid'].'"><img class="card-img-top object-fit object-fit_scale-down" src="images/p_'.($value['pid'] > 30 ? "30":$value['pid']).'.jpg" alt="no img"></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a style="display : inline-block; text-overflow : ellipsis; overflow: hidden; white-space : nowrap; width : 100%;" href="item.php?item_id='.$value['pid'].'">'.$value['name'].'</a>
                                    </h4>
                                    <h5>$'.$value['price'].'</h5>

                                </div>
                                <div class="card-footer">
                                <small class="text-muted"><div class="row"><div class="col-6">';
                            for($j = 0;$j < 5;$j++)
                                echo $j < ($value['star_count']==0?$value['star']:$value['star']/$value['star_count']) ? "&#9733; ":"&#9734; ";echo'</div><div class="col-2 offset-4"><div id="'.$value['pid'].'">';
                                if($value['stock']>0)
                                echo'<i class="fa fa-cart-plus fa-lg" onclick="nav_slide('.$log.');cart_1('.$value['pid'].','.$log.')"></i>';
                                else{echo'<i class="fas fa-times-circle"></i>';}    
                                    echo'</div></div>
                                    </div></small>
                            </div>
                            </div>
                        </div>
                    ';
                        $i++;
                        }
                    }
                    echo'</div><div class="row">';
                    if($index_search != 0) echo '<a href="?index_search='.($index_search-1).'"><button class="btn btn-primary">
                    上一頁
                </button></a>';
                    if(($index_search+1)*6 < count($contents)) echo '&emsp;<a href="?index_search='.($index_search+1).'"><button class="btn btn-primary">
                    下一頁
                </button></a>';
                echo'</div>';
                }
            ?>
            </div>
        </div>
        </div>
    </div>


    <!-- footer 最下面那一列-->
    <?php include "footer.php";?>
    <!-- <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script>
        var header = document.querySelector('nav');
        var headroom  = new Headroom(header);
        headroom.init();
    </script>  -->
    
</body>
</html>