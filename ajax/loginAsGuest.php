<?php
	require_once("../utils/authenticate.php");
	$auth = new authenticate();
	$auth->login("guest", "one");
	header('Location: ../index.php');
?>