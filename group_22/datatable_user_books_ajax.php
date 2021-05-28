<?php

include "link.php";

$arr_oper = array("insert" => "新增", "update" => "修改", "delete" => "刪除");
$oper = $_POST['oper'];

if ($oper == "query") {
      $sql = "select * from order_form";
      $a=array("data" => array());
      if ($result = mysqli_query($link, $sql)) {
            while ($row = mysqli_fetch_assoc($result)) {
                  $a['data'][] = array( $row["members_id"],$row["commodity_id"], $row["apply_for_return"],$row["order_count"], ($row["apply_for_return"] == 1 ? "<button type='button' class='btn btn-warning btn-xs' id='btn_update'>修改</button> <button type='button' class='btn btn-danger btn-xs' id='btn_delete'>核准退貨</button>":"<button type='button' class='btn btn-warning btn-xs' id='btn_update'>修改</button>"), $row["quantity"]);
            }
            mysqli_free_result($result); // 釋放佔用的記憶體
      }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}

if ($oper == "insert") {
      $sql = "insert into order_form(members_id,commodity_id,apply_for_return) values ('$_POST[account]',$_POST[pid],$_POST[apply_for_return])";
}

if ($oper == "update") {
      $sql = "update order_form set members_id='$_POST[account]',commodity_id=$_POST[pid],apply_for_return=$_POST[apply_for_return] where members_id='$_POST[account_del]' and commodity_id=$_POST[g_id_del]";
}

if ($oper == "delete") {
      $sql = "delete from order_form where members_id='$_POST[account_del]' and commodity_id=$_POST[g_id_del] and order_count=$_POST[tmdorder_count]";
}

if (strlen($sql) > 10) {
      if ($result = mysqli_query($link, $sql)) {
            if($oper == "delete")
            {
                  $sql2 = "update commodity set stock = stock + ".$_POST['quantity']." where pid = $_POST[g_id_del]";
                  mysqli_query($link, $sql2);
            }
            $a["code"] = 0;
            $a["message"] = "資料" . $arr_oper[$oper] . "成功!";
      } else {
            $a["code"] = mysqli_errno($link);
            $a["message"] = "資料" . $arr_oper[$oper] . "失敗! <br> 錯誤訊息: " . mysqli_error($link);
      }
      // if($oper == "delete")
      // {
      //       $sql2 = "update commodity set stock = stock + ".$_POST['quantity']." where commodity.pid = $_POST['g_id_del']";
      //       mysqli_query($link, $sql2);
      // }
      mysqli_close($link); // 關閉資料庫連結

      echo json_encode($a);
      exit;
}
?>