<?php
	include("templates/header.php");
	require_once("utils/dbconnect.php");
	require_once("utils/api.php");
	require_once("templates/display_labels.php");
	require_once("utils/authenticate.php");
	$db=getdb();

	session_start();
	$auth = new authenticate();

	if(isset($_SESSION['user_id'])) {
		$logged_in = $auth->checkSession();
	    if(!$logged_in) {
	        $auth->logout();
	        header('Location: login.php');
	    } 
	    else {
	    	$user_id = get_current_user_details($db, $_SESSION['user_id']);
			$upc = get_random_label($db, $user_id); 
			echo "<section id='container'>";
		    echo "<div class='row'>";
			echo "<div class='large-4 columns'>";
			display_img($upc);
			echo "</div>";
			echo "<div class='large-6 columns'>";
			display_label($db, $upc, $user_id);
			echo "</div>";//close display
		    echo "</div>";//close row
	        echo "</section>";
	        echo "<div class='clearfix'></div>";
	    }
    }
	else {
		header('Location: login.php');
	}
	    
		//TODO: add guest option 
	include("templates/footer.php");	
?>
