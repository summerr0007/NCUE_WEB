<?php 
    if($result){
        echo '<script>';
        echo "alert('新增成功');";
        echo "window.location.href='" . THISURL . "account/admin';";
        echo '</script>';
    }else{
        echo "error";
    }
?>