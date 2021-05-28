<?php
include "link.php";

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