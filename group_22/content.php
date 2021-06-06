<?php
include "link.php";

// switch($sort)
// {
//     case 1: $sql = "select * from commodity "; break;
//     case 2: $sql = "select * from commodity order by price"; break;
//     case 3: $sql = "select * from commodity order by price desc"; break;
//     default : $sql = "select * from commodity";
// }
$sql = "select * from commodity";/*表單名子 */

$content = array();
if($result = mysqli_query($link,$sql))
{
    while($row = mysqli_fetch_assoc($result))
        $content[$row['pid']] = $row;
    mysqli_free_result($result);
}
mysqli_close($link);
?>