<?php
	require_once("../utils/dbconnect.php");
	require_once("../utils/api.php");

	function set_admin($user){
	$db=getdb();
	$user_query= "update user set admin = 1 where user_id = $user";
	$result = $db->query($user_query);
	return true;
}
set_admin($_POST['userid']);
	return false;
?>
