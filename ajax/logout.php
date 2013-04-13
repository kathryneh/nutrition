<?php
	require_once("../utils/authenticate.php");
	$auth = new authenticate();
	$auth->logout();
	header('Location: ../login.php');
	exit();
?>