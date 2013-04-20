<?php
require_once("../utils/dbconnect.php");
require_once("../utils/authenticate.php");
$auth = new authenticate();

// remove any errors from last create attempt
session_start();
if(isset($_SESSION['create_error'])) {
	unset($_SESSION['create_error']);
}

// require username field to contain input
if(empty($_POST['username'])) {
	$_SESSION['create_error'] = "Username is required.";
	header('Location: ../signup.php');
	exit();
} 
else {
	// get user username attempt
	$username = $_POST['username'];
}

// require password fied to contain input
if(empty($_POST['password'])) {
	$_SESSION['create_error'] = "Password is required.";
	header('Location: ../signup.php?');
	exit();
} else {
	// get user password attempt
	$password = $_POST['password'];
}

// require password confirmation to contain input
if(empty($_POST['confirm_password'])) {
	$_SESSION['create_error'] = "Password confirmation required.";
	header('Location: ../signup.php');
	exit();
} else if(!($_POST['confirm_password'] == $password)) {
	// if password confirmation matches original password attempt
	$_SESSION['create_error'] = "Passwords do not match.";
	header('Location: ../signup.php');
	exit();
}

// require email field to contain input
if(empty($_POST['email'])) {
	$_SESSION['create_error'] = "Email address is required.";
	header('Location: ../signup.php');
	exit();
} else {
	// get user email attempt
	$email = $_POST['email'];
}

// attempt to create new user 
$error = $auth->createUser($username, $password, $email);
if($error == true) {
	$_SESSION['create_success'] = "New user created successfully. An email " .
	"has been sent to $email. Navigate to the URL provided to activate your account.";
	header('Location: ../signup.php');
} else {
	$_SESSION['create_error'] = "Could not create new user. Username already in use";
	header('Location: ../signup.php');
}
?>