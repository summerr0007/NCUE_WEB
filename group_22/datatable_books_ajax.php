<?php

include "link.php";

$arr_oper = array("insert" => "新增", "update" => "修改", "delete" => "刪除");
$oper = $_POST['oper'];

if ($oper == "query") {
      $sql = "select * from commodity";
      $a=array("data" => array());
      if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $a['data'][] = array($row["pid"],$row["name"],$row["author"],$row["publisher"],$row["date"],$row["price"],$row["summary"],$row["star"],$row["cate"],$row["stock"], "<button type='button' class='btn btn-warning btn-xs' id='btn_update'>修改</button> <button type='button' class='btn btn-danger btn-xs' id='btn_delete'>刪除</button>");
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}

if ($oper == "insert") {
      $sql = "insert into commodity (name,author,publisher,date,price,summary,star,cate,stock) values 
      ('$_POST[name]','$_POST[author]','$_POST[publisher]','$_POST[date]',$_POST[price],'$_POST[summary]',$_POST[star],'$_POST[cate]','$_POST[stock]')";
}

if ($oper == "update") {
      $sql = "update commodity set name='$_POST[name]',author='$_POST[author]',publisher='$_POST[publisher]',
      date=$_POST[date],price=$_POST[price],summary='$_POST[summary]',
      star=$_POST[star],cate='$_POST[cate]',stock='$_POST[stock]' where pid = $_POST[g_id_old]";
}

if ($oper == "delete") {
      $sql = "delete from commodity where pid=$_POST[g_id_old]";
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