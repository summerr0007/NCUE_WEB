<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-primary">
        <div class="container">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo THISURL?>">商品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo THISURL."shopcar/shopcar"?>">購物車</a>
                    </li>
                </ul>
            </div>
            <div class="mx-auto order-0">
                <a class="navbar-brand mx-auto" href="<?php echo THISURL?>">CD-DVD</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo THISURL."account/edit"?>"><?php if(!empty($_SESSION['login'])){echo "歡迎  ".$_SESSION['login'];}?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo THISURL."item/itemedit"?>"><?php if(!empty($_SESSION['loginid']) && $_SESSION['loginid'] == 2){echo "管理者介面";}?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo THISURL."account/login"?>"><?php if(empty($_SESSION['login'])){echo "登入";}?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo THISURL."account/register"?>"><?php if(empty($_SESSION['login'])){echo "註冊";}?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="<?php echo THISURL."account/logout"?>"><?php if(!empty($_SESSION['login'])){echo "登出";}?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>