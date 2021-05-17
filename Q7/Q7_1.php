<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q7_1</title>
</head>

<body>
    <form action='' method='POST' enctype='multipart/form-data'>
        <input type='hidden' name='MAX_FILE_SIZE' value='1024000'>
        請選擇要上傳的檔案：
        <input type='file' name='Myfile'><br>
        <input type='submit' value='上傳檔案'>
    </form>
</body>
<?php  
if(isset($_FILES['Myfile'])){
    echo "原始檔案名稱：" . $_FILES['Myfile']['name'];
    echo "<br>伺服器的暫存檔名：" . $_FILES['Myfile']['tmp_name'] ;
    echo "<br>檔案大小：" . $_FILES['Myfile']['size'] ;
    echo "<br>檔案的MIME格式：".$_FILES['Myfile']['type'];
    echo "<br>上傳的錯誤代碼：".$_FILES['Myfile']['error'];
    echo "<br>";
    if (move_uploaded_file($_FILES['Myfile']['tmp_name'],"C:/upload/" . $_FILES['Myfile']['name'])) echo "success move";
    else echo "fail move";
}

?>

</html>