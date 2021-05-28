<?php
$page = 1;
session_start();
include "content.php";
if(isset($_GET['index']))
    $index = intval($_GET['index']);
else
    $index = 0;
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
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script> 
        var top1 = 0;
        $(document).ready(function(){
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
            <?php include "left_side_bar.php";?>
            <div class="col-lg-10 ">
                <div style = "margin-top:30px"></div>
                <div class="row">
                    <?php
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
                        
                            <div class="card h-100" >
                                <a href="item.php?item_id='.$value['pid'].'"><img class="card-img-top object-fit object-fit_scale-down"  src="images/p_'.($value['pid'] > 30 ? "30":$value['pid']).'.jpg" alt="no img"></a>
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
                    ?>
                </div>
                <div class="row">
                    <?php
                        if($index != 0) echo '<a href="index.php?index='.($index-1).'"><button class="btn btn-primary">
                        上一頁
                    </button></a>';
                        if(($index+1)*6 < count($content)) echo '&emsp;<a href="index.php?index='.($index+1).'"><button class="btn btn-primary">
                        下一頁
                    </button></a>';
                    ?>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>


    <!-- footer 最下面那一列-->
    <?php include "footer.php";?>
    <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>