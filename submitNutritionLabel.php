<?php
	require_once("utils/dbconnect.php");
	require_once("utils/api.php");
	require_once("templates/display_labels.php");
	print_r($_POST);
	$db = getdb();
	//TODO: currently the userid is fixed
	// foreach ($_POST as $key => $value) {
	// 	function add_to_current_label($db, $upc, $column_name, $column_value){
	// }

?>