<?php
	function getPageName($IncludeSiteName = True) {
		$PageName = "";
		switch(basename($_SERVER['PHP_SELF'])) {
			case "index.php":			$PageName = "Dashboard";		break;
			case "feedback_form.php":	$PageName = "Feedback Form";	break;
		}
		
		return ($IncludeSiteName ? "VSIS | " : "") . $PageName;
	}
?>