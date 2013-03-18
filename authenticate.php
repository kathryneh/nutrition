<?php
require_once("utils/dbconnect.php");

class authenticate {
    private $_db;
    private $_siteKey;

    public function __construct($database) {
        //$this->siteKey = "nootch*roosh^shun!nay\ish*un&CALMP5TWINNYTHREE";
	$this->_db = $database;
    }


    private function randomString($length = 50) {
	$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
	$string = "";
	
	for ($i = 0; $i < $length; $i++) {
	    $string = $characters[mt_rand(0, strlen($characters))];
	}
	return $string;
    }


    private function hashData($data) {
        return hash_hmac('sha512', $data, $this->_siteKey);
    }


    public function isAdmin($userID) {
        $admin_query = "SELECT admin FROM user WHERE user_id = $userID";
	$admin = $db->query($admin_query);
	if($admin == 1) {
	    return true;
	} else {
	    return false;
	}
    }

    public function createUser($email, $password, $is_admin = 0) {
	$salt = $this->randomString();
	$password = $salt . $password;
	$password = $this->hashData($password);
	$verification_code = $this->randomString();
	$insert_query = "INSERT INTO user (email, password, password_digest, verification_code) values($email, $password, $salt, $verification_code)";
	$user_created = $db->query($insert_query);
	if($user_created) {
	    if($this->sendVerificationEmail($email, $verification_code) == 1) {
		echo "An email has been sent to the address you provided. Click the link to verify your account.";
  		return true;
	    }
	}
	return false;
    }

    public function sendVerificationEmail($email, $verification_code) {
	$subject = "NuTRUtion Account Verfication";
	$message = $verification_code;
	if(mail($email, $subject, $message) == 1) {
	    return true;
	} else {
	    return false;
	}
    }

    public function login($email, $password) {
	$id_query = "SELECT user_id FROM user WHERE email = $email";
	$id = $db->query($id_query);
	$digest_query = "SELECT password_digest FROM user WHERE user_id = $id";
	$digest = query($exists_query);
	$attempt_password = $salt . $password;
	$this->hashData($password);
	$password_query = "SELECT password FROM user WHERE user_id = $id";
	$saved_password = $db->query($password_query);
	if($attempt_password == $saved_password) {
	    $random = $this->randomString();
	    $token = $_SERVER['HTTP_USER_AGENT'] . $random;
	    $this->hashData($token);
	    session_start();
	    $_SESSION['token'] = $token;
	    $_SESSION['user_id'] = $id;
	    $delete_old_sessions_query = "DELETE FROM logged_in_user WHERE user_id = $id";
	    $db->query($delete_old_sessions_query);
	    $ses_id = session_id();
	    $add_new_session_query = "INSERT INTO logged_in_user(user_id, session_id, token) values($id, $ses_id, $token)";
	    if($db->query($add_new_session_query) == true) {
		return 0;
	    }
	    return 1;
	} else {
	    return 1;
	}
    }

    public function checkSession() {
	$user_id = $_SESSION['user_id'];
	$token_query = "SELECT token FROM user WHERE user_id = $user_id";
	$session_id_query = "SELECT session_id FROM user WHERE user_id = $user_id";
	$token = $db->query($token_query);
	$session_id = $db->query($session_id_query);
	if($token == $_SESSION['token'] && $session_id == session_id()) {
	    $this->refreshSession($user_id);
	    return true;
	}
	return false;
    }

    private function refreshSession($user_id) {
	session_regenerate_id();
	$random = $this->randomString();
	$token = $_SERVER['HTTP_USER_AGENT'] . $random;
	$token = $this->hashData($token);
	$_SESSION['token'] = $token;
	$session_id = session_id();
	$update_session_query = "UPDATE logged_in_user SET token = $token, session_id = $session_id WHERE user_id = $user_id";
	$refreshed = $db->query($update_session_query);
	return ($refreshed);
    }

    public function logout() {
	$user_id = $_SESSION['user_id'];
	$delete_query = "DELETE FROM logged_in_user WHERE user_id = $user_id";
	$db->query($delete_query);
	session_unset();
	session_destroy();
    }
}

?>
