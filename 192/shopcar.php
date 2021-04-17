<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CD-DVD</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.js"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script> 
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<script>
    $(document).ready(function () {   
        // $(".nonLoginTag").hide();  
        // $(".LoginTag").append("<li>ef</li>");
        var cookieLogin = Cookies.get('login_name') ;
        
        if(cookieLogin != undefined){
            $(".nonLoginTag").hide();
            // $(".LoginTag").append("<li style=\"color:#ffffff;font-size:18px\">>Hi "+cookieLogin +"</li>");
            $(".LoginTag").append("<li><a href=\"javascript:logout();\"> Hi "+cookieLogin +" Logout</a></li>");
        }else{
            $(".nonLoginTag").show();
        }
    });
    var logout= function(){ javascript:Cookies.remove('login_name'); location.href=".";   }
    var buy=function(){alert("好喔");}
</script>
<?php
    if(isset($_GET["d"])){
        dcar($_GET["d"]);
    }
    function dcar($res){
        if(isset($_COOKIE["shopcar"])){
            $data = unserialize($_COOKIE['shopcar']);
            $diff = array($res);
            $te = array_diff($data,$diff);
            setcookie('shopcar', serialize($te));
        }else{
            echo "<script>alert('error')</script>";
        }
        echo "<script>window.location.href='shopcar.php'</script>";
    }
?>
</head>
<body>
<!-- begin #container -->
<div id="container">
	<!-- begin #header -->
    <div id="header">
    	<div class="logo"><a href="index.php"><img src="images/logo.png" alt="慘了壞了" /></a></div>
        <!-- <div class="slogan">ONLINE STORE</div> -->
        <div class="clearfloat"></div>
    	<div class="headerTop">
        	<div class="menu">
            	<ul>
                	<li id="active"><a href="index.php">HOME</a></li>
                    <li id="active"><a href="index.php">購物車</a></li>
                </ul>
            </div>
            <div class="menu">
            	<ul class="nonLoginTag">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>                    
                </ul>
                <ul class="LoginTag">   
                             
                </ul>
            </div>
            <div class="clearfloat"></div>
        </div>
        <div>
        	<div class="headerPic"><img src="images/headerPic.jpg" alt="" /></div>
            <div class="headerSlogan">THE LATEST<br />FILM NEWS &#38; REVIEWS</div>
        </div>
        <div class="clearfloat"></div>
    </div>
    <!-- end #header -->
    <!-- begin #sidebar1 -->
    <div id="bb">
        <div id="sidebar1">
            <a href= "javascript:buy();"><h2>結帳</h2></a>

        </div>
        <!-- end #sidebar1 -->
        <!-- begin #mainContent -->
        <div id="mainContent">
            <?php 
                $string = file_get_contents("item.json");
                $oj = json_decode($string);
                if(!empty($_COOKIE['shopcar'])){
                    $ar = unserialize($_COOKIE['shopcar']);
                    if(!empty($ar)){                    
                        foreach($ar as $io){
                            echo "<div class=\"box\">".
                                    "<div><img src=\"".$oj->$io->src."\"/></div>".
                                    "<div class=\"boxTitle\">".$oj->$io->name."</div>".
                                    "<div class=\"boxPrice\">$22.44</div>".
                                    "<div class=\"boxLink\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"shopcar.php?d=".$oj->$io->num."\">Delete</a></div>".
                                "</div>";
                        }
                    }else{
                        echo "購物車是空的";
                    }
                }else{
                    echo "購物車是空的";
                }            
            ?>   
        </div>
    </div>
    <div class="clearfloat"></div>
    <!-- end #mainContent -->
    <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats --><br class="clearfloat" />
    <!-- begin #footer -->
    <div id="footer">
		<p>
        <br>
        </p>
	</div>
    <!-- end #footer -->
</div>
<!-- end #container -->
</body>
</html>
