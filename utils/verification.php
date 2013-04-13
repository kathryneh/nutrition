<?php 
require_once("dbconnect.php");
require_once("api.php");

//This returns the number of verifications that different users must go through
//before a value is considered to be correct. 
function get_verification_number($db){
	$config_query= "select count from config where id=1";
	$result = $db->query($config_query);
	$config = $result->fetch_assoc();
	return $config['count'];
}

//this updates the verifications that different users must go through before a
//value is considered to be correct. 
function set_verification_number($newNumber){
	$db=getdb();
	$config_query= "update config set count = $newNumber where id=1";
	$result = $db->query($config_query);
	return true;
}
set_verification_number($_POST['count']);

?>