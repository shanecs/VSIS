<?php
	// Open Connection
	include 'open_connection.php';
	
	// Execute Query
	$sql = "CALL GetInstructions(" . ((int)$_GET['CaseID']) . ")";
	$result = $conn->query($sql);
	
	// Process Data
	if (0 < $result->num_rows) {
		echo "<option selected disabled>Select an Instruction</option>";
		while($row = $result->fetch_assoc()) {
			echo "<option value=" . $row["InstructionID"] . ">" . $row["Instruction"] . "</option>";
		}
	} else {
		echo "<option selected disabled>No Instructions Exist for this Case</option>";
	}
	
	// Close Connection
	$conn->close();
?>