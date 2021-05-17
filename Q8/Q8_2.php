<?php

$link = mysqli_connect("localhost", "root", "root123456", "meeting") // 建立MySQL的資料庫連結
or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

//資料庫新增存檔
if (isset($_POST['m_name'])) {
    $sql = "insert into m_data (m_name,m_place,m_date,m_time,moderator) values ('" . $_POST['m_name'] . "','" . $_POST['m_place'] . "','" . $_POST['m_date'] . "','" . $_POST['m_time'] . "','" . $_POST['moderator']. "')";

    if ($result = mysqli_query($link, $sql)) // 送出查詢的SQL指令
    {
        $msg = "<span style='color:#0000FF'>資料新增成功!</span>";
    } else {
        $msg = "<span style='color:#FF0000'>資料新增失敗！<br>錯誤代碼：" . mysqli_errno($link) . "<br>錯誤訊息：" . mysqli_error($link) . "</span>";
    }

}

// 資料庫查詢
if ($result = mysqli_query($link, "SELECT * FROM m_data order by m_date,m_time")) {
    $rows="";
    while ($row = mysqli_fetch_assoc($result)) {

        $rows .= "<tr><td>" . $row["m_name"] . "</td><td>" . $row["m_place"] . "</td><td>" . $row["m_date"]  . "</td><td>". $row["m_time"] . "</td><td>" . $row["moderator"] . "</td></tr>";
    }
    $num = mysqli_num_rows($result); //查詢結果筆數
    mysqli_free_result($result); // 釋放佔用的記憶體
}

mysqli_close($link); // 關閉資料庫連結
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>資料庫查詢</title>
    <style>
        table {
            width: 500px;
            margin: 0 auto;
            border: 1px blue solid;
            border-collapse: collapse;
        }

        tr, td, th {
            border: 1px blue solid;
            text-align: center
        }
        caption{
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <table>
            <tr>
                <td class="col">會議名稱：</td><td><input type="text" name="m_name"></td>
                <td class="col">會議地點：</td><td><input type="text" name="m_place"></td>
            </tr>

            <tr>
                <td class="col">會議日期：</td><td><input type="text" name="m_date"></td>
                <td class="col">會議時間：</td><td><input type="text" name="m_time"></td>
            </tr>
            <tr><td class="col" colspan=4>會議主持人：<input type="text" name="moderator"></td></tr>
            <tr><td colspan="4"><button type="submit">新增存檔</button><div class="message"><?php if(isset($msg)) echo $msg?></div></td></tr>
        </table>
    </form>
    <table>
        <tr>
            <th>會議名稱</th>
            <th>會議地點</th>
            <th>會議日期</th>
            <th>會議時間</th>
            <th>會議主持人</th>
        </tr>
        <?php echo $rows; ?>
    </table>
</body>

</html>