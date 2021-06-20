<?php 
    if($result){
        echo '<script>';
        echo "alert('刪除成功');";
        echo "window.location.href='" . THISURL . "account/admin';";
        echo '</script>';
    }else{
        echo "error";
    }
?>