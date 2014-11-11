<?php
	require_once 'scripts/security/session.class.php';
	$session = new session();
	// Set to True if Using https
	$session->start_session('VSIS', false);
	
	/*
	$_SESSION['something'] = 'Test';
	echo $_SESSION['something'];
	*/
?>