<?php

include "link.php";

$arr_oper = array("insert" => "新增", "update" => "修改", "delete" => "刪除");
$oper = $_POST['oper'];

if ($oper == "query") {
      $sql = "select * from mycarousel";
      $a=array("data" => array());
      if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $a['data'][] = array($row["cid"],"<img src='images/".$row["pic"]."' height='10px' alt='no img'>",$row["ptitle"],$row["ptext"] , 
                  "<button type='button' class='btn btn-warning btn-xs' id='btn_update'>修改</button> <button type='button' class='btn btn-danger btn-xs' id='btn_delete'>刪除</button>");
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}

// if ($oper == "insert") {
//       $sql = "insert into mycarousel (cid,pic,ptitle,ptext) values 
//       ('$_POST[ann]','$_POST[pic]','$_POST[ptitle]','$_POST[ptext]')";
// }

if ($oper == "update") {
      $sql = "update mycarousel set pic='".$_POST['pic']."',ptitle='$_POST[ptitle]',ptext='$_POST[ptext]' where cid = $_POST[g_id_old]";
}

 if ($oper == "delete") {
    $sql = "update mycarousel set pic='',ptitle='',ptext='' where cid = $_POST[g_id_old]";
 }

if (strlen($sql) > 10) {
      if ($result = mysqli_query($link, $sql)) {
            $a["code"] = 0;
            $a["message"] = "資料" . $arr_oper[$oper] . "成功!";
            if($oper == "update")
            {
                
            }
      } else {
            $a["code"] = mysqli_errno($link);
            $a["message"] = "資料" . $arr_oper[$oper] . "失敗! <br> 錯誤訊息: " . mysqli_error($link);
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}
?>