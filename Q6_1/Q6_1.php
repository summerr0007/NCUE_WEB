<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q6_1</title>
    <style>
        table{
			width: 500px;
			border: 1px solid #000;
			border-collapse: collapse;
		}
		td{
			border: 1px solid #000;
			text-align: center
			
		}
		.c1{
			background-color: pink
		}
	</style>
</head>
<body>
    <form name="MyForm1" action="" method="POST">
        請輸入數字:
        <input type=text name="in"></input>
        <input type=submit></input>
    </form>
    <table>
        <?php
            if(isset($_POST["in"])){
                for($i=1;$i < 10;$i++){
                    $a=(int)$_POST["in"]*$i;
                    echo "<tr><td>". $_POST["in"]."</td><td>". $i."</td><td style=\"color:blue;background-color:pink;\">". $a."</td></tr>";
                 }
            }
        ?>
    </table>
    
</body>
</html>