<?php

include "link.php";

$arr_level = array(2 => "一般使用者(會員)", 3 => "管理者");
$arr_oper = array("insert" => "新增", "update" => "修改", "delete" => "刪除");
$oper = $_POST['oper'];

if ($oper == "query") {
      $sql = "select * from members";
      $a=array("data" => array());
      if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $a['data'][] = array($row["account"], $row["password"], $row["email"], $arr_level[$row["level"]], "<button type='button' class='btn btn-warning btn-xs' id='btn_update'>修改</button> <button type='button' class='btn btn-danger btn-xs' id='btn_delete'>刪除</button>");
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}

if ($oper == "insert") {
      $sql = "insert into members(account,password,email,level) values ('".$_POST['account']."','".$_POST['password']."','".$_POST['email']."',".$_POST['level'].")";
}

if ($oper == "update") {
      $sql = "update members set password='".$_POST['password']."',email='".$_POST['email']."',level=".$_POST['level'].",account='".$_POST['account']."' where account='".$_POST['account_old']."'";
}

if ($oper == "delete") {
      $sql = "delete from members where account='$_POST[account_old]'";
}

if (strlen($sql) > 10) {
      if ($result = mysqli_query($link, $sql)) {
            $a["code"] = 0;
            $a["message"] = "資料" . $arr_oper[$oper] . "成功!";
      } else {
            $a["code"] = mysqli_errno($link);
            $a["message"] = "資料" . $arr_oper[$oper] . "失敗! <br> 錯誤訊息: " . mysqli_error($link);
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}
?>