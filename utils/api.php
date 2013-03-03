<?php
//copy a label from new_label to current_label
//if it doesn't currently exist (i.e. enter it in w/ all values null)
//should they be null or should they be empty string? 
//use === to check for null


//submit a value to the database given a column name and value and upc
//aggregate this into one SQL statement? 
//making a different submission insertion for each. 


//check how many submissions are in the database of a value, column name, and upc


//get a label that the user has not yet submitted to


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
			echo "error creating new row in database";
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

function construct_display_label_content($db, $upc){
	$new = (get_new_label($db, $upc));
	print_r($new);
	echo "###";
	$current = (get_current_label($db, $upc));
	print_r($current);

	foreach ($new as $key => $value) {
		if($current[$key]){
			echo "current";
			echo $current[$key];
			echo "<br>";
		}
		else{
			echo $new[$key];
		}
	}
}

?>
