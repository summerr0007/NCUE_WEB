<?php
    include "link.php";
    $commend = array();
    $t = $content[$id]['cate'];
    $count = 0;
    $sql = "select * from commodity where cate='$t' ";
    if($result = mysqli_query($link,$sql))
    {
        while($row = mysqli_fetch_assoc($result))
        {
            if($row['pid'] != $content[$id]['pid'])
            {
                $commend[$count] = $row;
                $count++;
            }   
        }    
        mysqli_free_result($result);
        $choo = range(0,$count-1);
        shuffle($choo);
    }
    mysqli_close($link);
?>