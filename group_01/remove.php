<?php
  session_start();
  $link = mysqli_connect("localhost", "root", "root123456", "group_01") // 建立MySQL的資料庫連結
  or die("無法開啟MySQL資料庫連結!<br>");
  // 送出編碼的MySQL指令
  mysqli_query($link, 'SET CHARACTER SET utf8');
  mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");    
  $user = $_SESSION['account'];
  $data = "";
  $nums = 0;
  $inventory=1;
  if(isset($_GET['product']))
  { 
      $p_name = $_GET['product'];
      $result = mysqli_query($link, "SELECT * FROM cart where account = '$user'");
      if($row = mysqli_fetch_assoc($result))
        $nums = "$row[nums]";
      $result = mysqli_query($link, "SELECT * FROM product where name = '$p_name'");
      if($row = mysqli_fetch_assoc($result))
        $inventory = "$row[inventory]";
      $inventory = $inventory + $nums;
      mysqli_query($link, "UPDATE product SET inventory=".$inventory." WHERE name = '". $p_name ."'");
      $sql = "delete from cart where product_name = '".$_GET['product']."' and account = '$user'";
      mysqli_query($link, $sql);
      if ($result = mysqli_query($link, "SELECT * FROM cart where account = '$user'" )) {
        while ($row = mysqli_fetch_assoc($result)) {                
          $data .= "<tr><td align = 'center' valign='center'><img src='assets/images/".$row['id']."' height='100' width='100'></td><td align = 'center' valign='center' style='font-size:18px;'>" . $row["product_name"] . "</td><td align = 'center' valign='center' style='font-size:18px;'>" . $row["product_price"] . "</td><form action='' method='POST'>
          <td align = 'center' valign='center'><button type='submit' class='btn btn-danger btn-xs' onclick='remove(" .'"'. $row["product_name"] .'"'.")'><i class='fa fa-times' aria-hidden='true'></i></button></td></form>";
      }
      echo $data; 
      mysqli_free_result($result); // 釋放佔用的記憶體
    }
  }
  mysqli_close($link); // 關閉資料庫連結
?>