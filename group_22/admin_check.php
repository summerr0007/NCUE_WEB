<?php
session_start();
if(!(isset($_SESSION['level']) and $_SESSION['level'] == 3))
    header("location: login.php");
?>