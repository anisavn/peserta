<?php
$page=isset($_GET['p']) ? $_GET['p'] : 'home';
	if($page=='home') include ('home.php');
	if($page=='biodata') include ('biodata.php');
?>