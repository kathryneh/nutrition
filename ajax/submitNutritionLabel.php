<?php
	require_once("utils/dbconnect.php");
	require_once("utils/api.php");
	require_once("templates/display_labels.php");
	print_r($_POST);
	$db = getdb();
	$upc = $_POST['upc'];
	$userid = 1;
	//TODO: currently the userid is fixed 
	foreach ($_POST as $column_name => $column_value) {
		if($column_name === 'upc'){
			//skip
		}
		else{
			submit_correction($db, $userid, $upc, $column_name, $column_value);
		}
	}

?>