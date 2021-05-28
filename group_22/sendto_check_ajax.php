<?php
$account = trim($_GET['account']) ;//把字串空白清掉
include "link.php";
$sql = "SELECT * FROM members where account='$account'";
if ( $result = mysqli_query($link, $sql) ) {
    if( $row = mysqli_fetch_assoc($result) ) 
        echo "1";
    else 
        echo "0";

    mysqli_free_result($result);
}
mysqli_close($link);
?>