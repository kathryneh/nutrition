<?php
//copy a label from new_label to current_label
//if it doesn't currently exist (i.e. enter it in w/ all values null)
//should they be null or should they be empty string? 
//use === to check for null
function add_to_current_label($db, $upc, $column_name, $column_value){
	$insert_qry = "update current_label set $column_name = $column_value where upc = $upc";
	echo $insert_qry;
	$insert_id = $db->query($insert_qry);
}

//submit a value to the database given a column name and value and upc
//aggregate this into one SQL statement? 
//making a different submission insertion for each. 
function submit_correction($db, $userid, $upc, $column_name, $column_value){
	$insert_qry = "insert into submission (userid, upc, column_name, column_value) values($userid, '$upc', '$column_name', $column_value);";
	$insert_id = $db->query($insert_qry);
	$count = count_matching_submissions($db, $upc, $column_name, $column_value);
	//TODO: make an admin screen so that this can be editable by the users. 
	if($count > 10){
		add_to_current_label($db, $upc, $column_name, $column_value);
	}
	else{
		//not yet a correct label;
	}
}

//check how many submissions are in the database of a value, column name, and upc
function count_matching_submissions($db, $upc, $column_name, $column_value){
	//TODO something's wrong here. 
	//count isn't returning anything. 
	// $db = getdb();
	// $count_qry = "select count(*) as count from submission where upc=$upc and column_name='$column_name' and column_value=$column_value;";
	// $countObj = $db->query($count_qry);
	// $count=mysql_fetch_assoc($count_qry);
	// return $count['count'];
}

//TODO: get a label that the user has not yet submitted to
//SELECT col1 FROM tbl WHERE [[not in complete_label or userid in submission table...]] RAND()<=0.0006 [percentage of total] limit 1;

//get values in new_label that are not in current_label
function get_current_label($db, $upc){
	$current_label_query = "select * from current_label where upc=$upc";
	$current_label = $db->query($current_label_query);
	if($current_label->num_rows == '0'){
		//if it doesn't exist, copy it to the current_label table
		$new_current_label = "insert into current_label (upc) values ($upc)";
		$db->query($new_current_label);
		if(is_null($db->insert_id)){
			echo "error creating new row in database";
		}
		else{
			$current_label_query = "select * from current_label where upc=$upc";
			$current_label = $db->query($current_label_query);
		}
	}
	$current_contents = array();
	while($row = $current_label->fetch_assoc()){
	    foreach($row as $key=>$value) {
            if($value != NULL){ //do we need this check or do we still want to check for these things from users?
	            $current_contents = array_merge($current_contents, array($key => $value));
            }
        }
    }
    return $current_contents;
}

//get values from new_label
function get_new_label($db, $upc){
	$new_label_query = "select * from new_label where upc=$upc";
	$new_label = $db->query($new_label_query);
	$new_contents = array();
	while($row = $new_label->fetch_assoc()){
	    foreach($row as $key=>$value) {
            //if($value != NULL){ //do we need this check or do we still want to check for these things from users?
	        $new_contents = array_merge($new_contents, array($key => $value));
            //}
        }
    }
	return $new_contents;
}


?>
