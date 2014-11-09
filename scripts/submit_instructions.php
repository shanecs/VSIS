<?php
	// Open Connection
	include 'open_connection.php';
	
	// Execute Query
	$sql = "CALL SaveRecord(" . ((int)$_POST['MRN']) . ", " . ((int)$_POST['InstructionID']) . ", " . ((int)$_POST['Value']) . ")";
	$result = $conn->query($sql);
		
	// Close Connection
	$conn->close();
	
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	// header('Location: index.php');
?>