<?php
	include("templates/header.php");
	require_once("utils/dbconnect.php");
	require_once("utils/orm.php");
	$db=getdb();
	
	display_label($db, '003000005586');
	display_img('003000005586');
	include("templates/footer.php");	
?>

