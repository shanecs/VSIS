<?php
	require_once 'access.php';
	require_once 'session.class.php';

	class UserCredentials {
		// property declaration
		private $db;
		private $POST;
		private $UserInfo;
		public $session;
		
		function __construct() {
			$this->getUserInfo();
		}
		
		// method declaration
		private function getLoginInfo() {
			$this->POST->Username = $_POST['VUnetID'];
			$this->POST->Password = $_POST['Password'];
		}
		
		private function setDBInfo() {
			$this->DB->ServerName = 'localhost';
			$this->DB->Username = 'vsis_secure';
			$this->DB->Password = 'E60V(sYw_j{xCF6iG[v)y>5]TdZRJ_*';
			$this->DB->Name = 'VSIS';
		}
		
		private function openConnection() {
			// Set Database Information
			$this->setDBInfo();
			
			// Create Connection
			$this->db->conn = new mysqli($this->DB->ServerName, $this->DB->Username, $this->DB->Password, $this->DB->Name);

			// Check Connection
			if($this->db->conn->connect_error) {
				die("Connection Failed: " . $this->db->conn->connect_error);
			}
		}
		
		private function getUserInfo() {
			// Get Login Information
			$this->getLoginInfo();
			
			// Open DB Connection
			$this->openConnection();
			
			// Prepare Statement
			$this->db->sql = "SELECT VSISid, VUnetID, UserLevel, `Password` FROM Users WHERE VUnetID = ?";
			$stmt = $this->db->conn->prepare($this->db->sql);
			$stmt->bind_param('s', $this->POST->Username);  // Bind $_POST['VUnetID'] to parameter.
			$stmt->execute();    // Execute the prepared query.
			$stmt->store_result();
			$stmt->bind_result($this->UserInfo->VSISid, $this->UserInfo->VUnetID, $this->UserInfo->UserLevel, $this->UserInfo->Password);
			$stmt->fetch();
			
			if($stmt->num_rows == 1) {
				$this->UserInfo->exists = true;
//				$this->POST->Password = password_hash($this->POST->Password, PASSWORD_DEFAULT);
			} else {
				$this->UserInfo->exists = false;
			}
			
			$this->saveUserInfo();
			
			// Close DB Connection
			$this->closeConnection();
		}
		
		private function saveUserInfo() {
			// Open the Session
			$this->openSession();
			
			if($this->UserInfo->exists && password_verify($this->POST->Password, $this->UserInfo->Password)) {
				$_SESSION['IsLogedIn'] = 1;
				$_SESSION['VSISid'] = $this->UserInfo->VSISid;
				$_SESSION['VUnetID'] = $this->UserInfo->VUnetID;
				$_SESSION['UserLevel'] = $this->UserInfo->UserLevel;
			} else {
				logout();
			}
		}
		
		private function openSession() {
			$this->session = new session();
			$this->session->start_session('VSIS', false);
		}
		
		private function closeConnection() {
			$this->db->conn->close();
			return true;
		}
		
		public function checkUser() {
			if($_SESSION['IsLogedIn'] == 1) {
				return true;
			} else {
				return false;
			}
		}
	}
?>