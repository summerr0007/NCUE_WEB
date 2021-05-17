<?php
    //資料庫連結
    $conn=mysqli_connect('127.0.0.1','root','root123456','school') or die("Error acc");

    $sql = "SELECT stud_no,stud_name,stud_addr FROM students"; //修改成你要的 SQL 語法
    $result = mysqli_query($conn,$sql) or die("Error se");

    $data_nums = mysqli_num_rows($result); //統計總比數
    $per = 10; //每頁顯示項目數量
    $pages = ceil($data_nums/$per); //取得不小於值的下一個整數
    if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
        $page=1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
    $start = ($page-1)*$per; //每一頁開始的資料序號
    $result = mysqli_query($conn,$sql.' LIMIT '.$start.', '.$per) or die("Error da");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q8_1</title>
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
<table>
<tr>
    <td style="text-align: center;">學號</td>
    <td style="text-align: center;">姓名</td>
    <td style="text-align: center;">地址</td>
</tr>
<?php
//輸出資料內容
while ($row = mysqli_fetch_array ($result))
{
    $id=$row['stud_no'];
    $name=$row['stud_name'];
    $addr = $row['stud_addr'];
    ?>
    
    <tr>
        <td style="text-align: center;"><?php echo $id; ?></td>
        <td style="text-align: center;"><?php echo $name; ?></td>
        <td style="text-align: center;"><?php echo $addr; ?></td>
    </tr>

<?php 
    }
?>
    <tr>
        <td colspan=3>
            <?php
            //分頁頁碼
            echo '共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁';
            echo "<br /><a href=?page=1>首頁</a> ";
            echo "第 ";
            for( $i=1 ; $i<=$pages ; $i++ ) {

                echo "<a href=?page=".$i.">".$i."</a> ";
            } 
            echo " 頁 <a href=?page=".$pages.">末頁</a><br /><br />";
            ?>
        </td>
    </tr>
</table>

<br />


</body>
</html>


