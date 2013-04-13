<?php
	
	//submitNutritionLabel.php
	//This file is called by the index page and is involved in sending the 
	//user entered data to the database.
	//
	require_once("../utils/dbconnect.php");
	require_once("../utils/api.php");
	$db = getdb();

	$upc = $_POST['upc'];
	$user_id = $_POST['user_id'];
	//This works by iterating through each row of the submitted nutrition label
	//and submitting the correction to the submission table. Each submission in the 
	//submission table is checked against other submissions of the same value. 
	foreach ($_POST as $column_name => $column_value) {
		if($column_name === 'upc'){
			//skip
			//TODO should do error checking here and insert if necessary...
		}
		else if($column_name === 'user_id'){
			//skip
		}
		else{
	//If the number of matching submissions for a column of the nutrition label table 
	//is greater than the verification number set in the admin page then the current 
	//label table will be updated with this "known" value.
			submit_correction($db, $user_id, $upc, $column_name, $column_value);
		}
	}
	//now after submitting check if the row is complete
	$current_label = get_current_label($db, $upc);
	$done = 1;
	foreach($current_label as $key => $value){
		//if there is a key/value pair, then the row has a value
		//otherwise it will be null and this won't be called
		$done++;
	}
	
	if($done > 35){
		//the label is complete, and we can consider that label complete
		//and add it to the completed table. 
		copy_current_to_complete($db, $upc, $current_label);
	}
	return true;
?>