<?php
	print_r($_POST);
	$count = $_POST['number_verifications'];
	set_verification_number($count);
	echo "hi";
?>