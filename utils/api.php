<?php
	require_once("verification.php");

//selects a random label from the database
//where the user has not yet submitted a correction for the values
//of this label. 
function get_random_label($db, $userid){
	$select_qry= "select upc from new_label where new_label.upc not in (select upc from complete_label) order by rand() limit 1";
	$result = $db->query($select_qry);
	$label = $result->fetch_assoc();
	return $label['upc'];
}

//"select upc from new_label where 
//	new_label.upc NOT IN (
//		select submission.upc from submission where 
//			userid = 14 and 
//			submission.upc NOT IN ( 
//			select upc from complete_label)) order by rand()";

//copy a label from new_label to current_label
//if it doesn't currently exist (i.e. enter it in w/ all values null)
//should they be null or should they be empty string? 
//use === to check for null
function add_to_current_label($db, $upc, $column_name, $column_value){
	$create_qry = "insert into current_label(upc) values($upc)"; 
	$insert_upc = $db->query($insert_qry);
	$insert_qry = "update current_label set $column_name = '$column_value' where upc = $upc";
	$insert_id = $db->query($insert_qry);
}

//submit a value to the database given a column name and value and upc
//aggregate this into one SQL statement? 
//making a different submission insertion for each. 
function submit_correction($db, $userid, $upc, $column_name, $column_value){
	$insert_qry = "insert into submission (userid, upc, column_name, column_value) values($userid, '$upc', '$column_name', '$column_value')";
	$insert_id = $db->query($insert_qry);
	$count = count_matching_submissions($db, $upc, $column_name, $column_value);
	$complete = get_verification_number($db);
	if($count > $complete){
	 	add_to_current_label($db, $upc, $column_name, $column_value);
	}
	else{
		//not yet a correct label;
	}
}

//check how many submissions are in the database of a value, column name, and upc
function count_matching_submissions($db, $upc, $column_name, $column_value){
	$count_qry = "select * from submission where upc=$upc and column_name='$column_name' and column_value='$column_value';";
	$count = 0;
	$results = $db->query($count_qry);
	while($row = $results->fetch_assoc()){
		$count++;
	}
	return $count;
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

function copy_current_to_complete($db, $upc, $current_label){
	$remove_qry = "delete from complete_label where upc = $upc";
	$db->query($remove_qry);
	$complete_qry = "insert into complete_label select current_label.* from current_label where upc = $upc";
	$db->query($complete_qry);
	if(is_null($db->insert_id)){
		echo "error creating new row in complete_label";
	}
	else{
		echo "done!";
	}
}

function make_admin($db, $user_id){
	$admin_update = "update user set admin = 1 where user_id = $user_id";
	$result = $db->query($admin_update);
}

function update_user($db, $user_id, $first, $last, $email, $password, $confirm_password){
	//TODO need to modify this to match what Tommy did in authenticate. 
	$update_user = "update user set first = $first, last = $last, email = $email, password_digest = $password, verification_code = $confirm_password where user_id = $user_id";
	$result = $db->query($update_user);
}
function get_current_user_details($db, $user_id){
	$user_query = "select * from user where username = '$user_id'";
	$result = $db->query($user_query);
	$user = $result->fetch_assoc();
	return $user['user_id'];	
}
?>
