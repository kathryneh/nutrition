<?php
	require_once("../utils/dbconnect.php");
	require_once("../utils/authenticate.php");
	$auth = new authenticate();

	// remove  errors, if any, from last login attempt
	session_start();

	if(isset($_SESSION['user_id'])) {
		$auth->logout();
		header('Location: ../index.php');
	}

	// require username field to contain input
	if(empty($_POST['username'])) {
		$_SESSION['login_error'] = "Username is required.";
		header('Location: ../login.php');
		exit();
	} else {
		// get user username attempt 
		$username = $_POST['username'];
	}

	// require password field to contain input
	if(empty($_POST['password'])) {
		$_SESSION['login_error'] = "Password is required.";
		header('Location: ../login.php');
		exit();
	} else {
		// get user password attempt
		$password = $_POST['password'];
	}
	
	// check if correct username/password pair
	if($auth->login($username, $password) === true) {
		// let user begin verifying
		$_SESSION['user_id'] = $username;
		header('Location: ../index.php');
	} else {
		// send user back to login for another try
		$_SESSION['login_error'] = "Incorrect username or password.";
		header('Location: ../login.php');
	}
?>
