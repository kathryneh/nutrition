<?php
	require_once("../utils/dbconnect.php");
	require_once("../utils/api.php");
	$db = getdb();
	$upc = $_POST['upc'];
	$user_id = $_POST['user_id'];
	foreach ($_POST as $column_name => $column_value) {
		if($column_name === 'upc'){
			//skip
			//TODO should do error checking here and insert if necessary...
		}
		else if($column_name === 'user_id'){
			//skip
		}
		else{
			submit_correction($db, $user_id, $upc, $column_name, $column_value);
		}
	}
	//now after submitting check if the row is complete
	$current_label = get_current_label($db, $upc);
	$done = 1;
	foreach($current_label as $key => $value){
		$done++;
	}
	
	if($done > 35){
		copy_current_to_complete($db, $upc, $current_label);
	}
	return true;
?>