<?php
	include("templates/header.php");
	require_once("utils/dbconnect.php");
	require_once("utils/api.php");
	require_once("templates/display_labels.php");
	require_once("utils/authenticate.php");
	$db=getdb();
	
	
	//session_start();
	//$auth = new authenticate();
	
	//TODO the authenticate class seems to be buggy

	// if(!isset($_SESSION['user_id'])) {
	//     header('Location: login.php');
	// }
	// else {
	//     $logged_in = $auth->checkSession();
	//     if(empty($logged_in)) {
	// 		$auth->logout();
	// 		header('Location: login.php');
	//     } 
	//     else {
	    	$upc = '003000005586';
			echo "<section id='container'>";
		    echo "<div class='row'>";
			echo "<div class='large-5 columns'>";
			display_img('003000005586');
			echo "</div>";
			echo "<div class='large-7 columns'>";
			display_label($db, $upc);
			echo "</div>";
		    echo "</div>";
	        echo "</section>";
	        echo "<div class='clearfix'></div>";
	   //  }
    // }
	
		//TODO: add guest option 

	include("templates/footer.php");	
?>
