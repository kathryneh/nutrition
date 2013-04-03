<?php
require_once("dbconnect.php");

class authenticate {
	private $_db;
	private $site_key = "nuTRUtion";

	public function __construct() {
		$this->_db = getdb();
	}

	private function randomString() {
		$length = 50;
		$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
		$string = "";
		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
		return $string;
	}

	private function hashData($data) {
		return hash_hmac('sha512', $data, $this->_siteKey);
	}

	public function isAdmin($username) {
		$admin_query = "SELECT admin FROM user WHERE username = '$username'";
		$admin = $db->query($admin_query);
		if($admin == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function createUser($username, $password, $email) {
		$password_digest = $this->hashData($password);
		$verification_code = $this->randomString();
		$exists_query = "SELECT * FROM user WHERE username = $username";
		$cursor = $this->_db->query($exists_query);
		//if(mysqli_fetch_assoc($cursor)['username'] != NULL) {
		//	return "Username already exists.";
		//}
		// check if username already exists
		$insert_query = "INSERT INTO user (username, email, password_digest, verification_code) values('$username', '$email', '$password_digest', '$verification_code')";
		if($this->_db->query($insert_query)) {
			if($this->sendVerificationEmail($email, $username, $verification_code)) {
				return true;
			}
			else {
				$remove_query = "DELETE FROM user WHERE username = $username";
				$db->query($remove_query);
				return "Problem sending verification email. Please contact staff.";
			}
		}
		return "create error";
	}

	public function sendVerificationEmail($email, $username, $verification_code) {
		$subject = "NuTRUtion Account Verfication";
		$message = "Hi $username,\n\n".
		"Thank you for your desire to participate in NuTRUtion data verification! " .
		"Please click the link below to verify your account. You will be redirected " .
		"to the data verification page after authentication.\n\n" .
		$verification_code . "\n\nThanks,\nThe NuTRUtion Team";
		if(mail($email, $subject, $message)) {
			return true;
		} else {
			return false;
		}
	}

	public function login($username, $password) {
		session_start();
		$password_digest = $this->hashData($password);
		$password_query = "SELECT password_digest FROM user WHERE username = '$username'";
		$cursor = $this->_db->query($password_query);
		$row = mysqli_fetch_assoc($cursor);
		if($row['password_digest'] == NULL) {
			return false;
		} elseif ($row['password_digest'] == $password_digest) {
			$random = $this->randomString();
			$token = $_SERVER['HTTP_USER_AGENT'] . $random;
			$token = $this->hashData($token);
			$_SESSION['token'] = $token;
			$_SESSION['user_id'] = $username;
			$delete_old_sessions_query = "DELETE FROM logged_in_user WHERE username = '$username'";
			$this->_db->query($delete_old_sessions_query);
			$ses_id = session_id();
			$add_new_session_query = "INSERT INTO logged_in_user(username, session_id, token) values('$username', '$ses_id', '$token')";
			return $this->_db->query($add_new_session_query);
		}
		return false;
	}

	public function checkSession() {
		if(!isset($_SESSION['user_id'])) {
			return false;
		}
		$username = $_SESSION['user_id'];
		$session_query = "SELECT token, session_id FROM logged_in_user WHERE username = '$username'";
		$cursor = $this->_db->query($session_query);
		$row = mysqli_fetch_assoc($cursor);
		if($row['token'] == $_SESSION['token'] && $row['session_id'] == session_id()) {
			return $this->refreshSession($username);
		}
		return false;
	}

	private function refreshSession($username) {
		session_regenerate_id();
		$random = $this->randomString();
		$token = $_SERVER['HTTP_USER_AGENT'] . $random;
		$token = $this->hashData($token);
		$_SESSION['token'] = $token;
		$session_id = session_id();
		$update_session_query = "UPDATE logged_in_user SET token = '$token', session_id = '$session_id' WHERE username = '$username'";
		return $this->_db->query($update_session_query);
	}

	public function logout() {
		session_start();
		$username = $_SESSION['user_id'];
		$delete_query = "DELETE FROM logged_in_user WHERE username = '$username'";
	    $this->_db->query($delete_query);
		session_unset();
		//session_destroy();
	}
}
?>