<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header('Location: '.$uri.'group_22/test3.php');
	exit;
?>