<?php
	include("templates/header.php");
	require_once("utils/dbconnect.php");
	require_once("utils/api.php");
	require_once("templates/display_labels.php");
	$db=getdb();

	//TODO: add if/else login + guest option + session variables + admin checking
	
	echo "<section id='container'>";
	echo "<form id='adminLabel' onsubmit='return submitAdminForm();'>";

	echo "</form>";
	echo "</section>";


	include("templates/footer.php");	
?>

