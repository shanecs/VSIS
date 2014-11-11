<?php
	function getPageName($IncludeSiteName = True) {
		$PageName = "";
		switch(basename($_SERVER['PHP_SELF'])) {
			case "feedback_form.php":	$PageName = "Feedback Form";	break;
			case "index.php":			$PageName = "Dashboard";		break;
			case "login.php":			$PageName = "Login";		break;
		}
		
		return ($IncludeSiteName ? "VSIS | " : "") . $PageName;
	}
?>