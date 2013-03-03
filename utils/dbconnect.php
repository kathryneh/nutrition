<?php

function getdb() {
	$host="mydb";

	$username="kathryne";
	$password="comp523";

	$database="nutritiondb";
	
	$dbh = mysql_connect($host,$username,$password) or die("Cannot conect to the database: ".mysql_error());
	$db_selected = mysql_select_db($database) or die ('Cannot connect to the database: ' . mysql_error());
	
	$mysqli = new mysqli($host, $username, $password, $database);
	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	return $mysqli;
}


function getResults($stmt) {

	$meta = $stmt->result_metadata();
	while ($field = $meta->fetch_field()){
		$params[] = &$row[$field->name];
	}
	
	call_user_func_array(array($stmt, 'bind_result'), $params);

	while ($stmt->fetch()) {
		foreach($row as $key => $val) {
			$c[$key] = $val;
		}
		$result[] = $c;
	}
		return $result;
}

function checkDB($db){
	$prepQry = "select * from new_label";
	$result = $db->query($prepQry);

	while($row = $result->fetch_assoc()){
	    foreach($row as $key=>$value) {
            echo "$key";
            echo "$value";
        }
        echo "\n";
    }
}

getdb();
?> 
