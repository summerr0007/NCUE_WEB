<?php
session_start();
session_destroy();
echo "<script>window.location.assign('index.php?log_out=1'); </script>";
?>