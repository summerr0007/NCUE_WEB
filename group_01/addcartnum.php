<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = Array();
}
$id = $_GET['id'];//商品ID
//若商品未在購物車中,則加入購物車(陣列)
if (!in_array($id,$_SESSION['cart'])){
   array_push($_SESSION['cart'],$id);
}
//返回上一頁
$url = $_SERVER['HTTP_REFERER'];
header("Location:$url");

?>