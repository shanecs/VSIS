<?php
	// Variables
	$ServerName = "localhost";
	$UserName = "vsis";
	$Password = ",}qxmFZ@3eN)";
	$DBName = "VSIS";

	// Create Connection
	$conn = new mysqli($ServerName, $UserName, $Password, $DBName);
	
	// Check Connection
	if($conn->connect_error) {
		die("Connection Failed: " . $conn->connect_error);
	} 
?>