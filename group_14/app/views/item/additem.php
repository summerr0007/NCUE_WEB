<?php 
    if($result){
        echo '<script>';
        echo "alert('新增成功');";
        echo "window.location.href='" . THISURL . "item/itemedit/';";
        echo '</script>';
    }else{
        echo "error";
    }
?>