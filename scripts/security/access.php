<?php
	require_once 'userCredentials.class.php';
	require_once 'session.class.php';
	
	$session = new session();
	$session->start_session('VSIS', false);
	
	function login() {
		require_once 'colobe-lib.php'; // Include the Colobe Library
		
		// Starts the Session
		$session = new session();
		$session->start_session('VSIS', false);

		// Control if the client is reliable or not first to check if the login data are correct or not
		$client_info = colobe_get_client_info();
		$UserCredentials = new UserCredentials();
		if(!($client_info == 1 || $client_info == -1) && false) {
			// Not show any information about the login data (for example if the password is correct or not)
			colobe_log_login(2); // Outcome = 2
			header('Location: /login.php?Code=2');

			echo 'Denied Access!';
		} else if($UserCredentials->checkUser()) {
			// send the login outcome to Colobe
			colobe_log_login(1); // outcome = 1
			
			header('Location: /index.php');
		} else {
			// Send the Login Outcome to Colobe
			colobe_log_login(0); // outcome = 0
			header('Location: /login.php?Code=0');

			echo 'Invalid Username and/or Password!';
		}
	}
	
	function logout() {
		$_SESSION['IsLogedIn'] = 0;
		$_SESSION['VSISid'] = null;
		$_SESSION['VUnetID'] = null;
		$_SESSION['UserLevel'] = -1;
		
		header('Location: /login.php?Code=3');
	}
	
	function checkUser($minLevel = 0, $explicitLevel = array()) {
		$login = (isset($_SESSION['IsLogedIn']) && $_SESSION['IsLogedIn'] == 1);
		$active = ($_SESSION['UserLevel'] != -1) && $status;
		$level = ($minLevel <= $_SESSION['UserLevel'] || in_array($explicitLevel, $_SESSION['UserLevel']) || $_SESSION['UserLevel'] == 9) && $status;
		syslog(LOG_DEBUG, 'checkUser Called');
		if(!$login || !active) {
			header('Location: /login.php');
		} else if(!$level) {
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
?>