<?php
	require_once("../utils/dbconnect.php");
	require_once("../utils/api.php");
	$db = getdb();
	$userid = $_POST['userid'];
	$username = $_POST['username'];
	$first = $_POST['first'];
	$last = $_POST['last'];
	$email = $_POST['email'];

	//TODO need to be able to update password too...
	update_user($db, $userid, $username, $first, $last, $email);
	return false;
?>
