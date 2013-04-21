<?php 
	require_once("../utils/authenticate.php");
	$auth = new authenticate();
	echo $_GET['code'];
	if($auth->verify($_GET['code'])===true){
		header('Location: ../index.php');
	}
?>
