<?php 
    if($result){
        echo '<script>';
        echo "alert('修改成功');";
        echo "window.location.href='" . THISURL . "item/itemedit/';";
        echo '</script>';
    }else{
        echo "error";
    }
?>