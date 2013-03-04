<?php
	include("templates/header.php");
	require_once("utils/dbconnect.php");
	require_once("utils/api.php");
	require_once("templates/display_labels.php");
	$db=getdb();
	$upc = '003000005586';
	echo "<section id='container'>";
		echo "<div class='row'>";
			echo "<div class='large-6 columns'>";
			display_img('003000005586');
			echo "</div>";
			echo "<div class='large-6 columns'>";
			display_label($db, $upc);
			echo "</div>";
		echo "</div>";
	echo "</section>";
	echo "<section>";
	//echo construct_display_label_content($db, $upc);
	echo "</section>";
	include("templates/footer.php");	
?>

