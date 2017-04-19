<?php


session_start();

class Dao{

	private $host = "us-cdbr-iron-east-04.cleardb.net";
	private $db = "heroku_7c7e52d3d784a22";
	private $user = "b0b5964e815b95";
	private $password = "d0e8855d";
	
	public function getConnection(){
		return
			new PDO ("mysql:host={$this->host};dbname={$this->db}",$this->user,$this->password);
	}
	
	public function saveNewUser($firstname,$lastname,$password1,$email,$dob){
		$conn = $this -> getConnection();
		$passwordHashed = password_hash($password1, PASSWORD_DEFAULT);
		$userStatus = 1;
		$userType = 3;
		$saveQuery = 
			"INSERT INTO newuser (email,fname,lname,pword, userID ,DOB)
			VALUES 
			(:email,:fname,:lname,:pword,:userID,:DOB)";
		$q = $conn ->prepare($saveQuery);
		$q -> bindParam(":email",$email);
		$q -> bindParam(":fname",$firstname);
		$q -> bindParam(":lname",$lastname);
		$q -> bindParam(":pword",$passwordHashed);
		$q -> bindParam(":userID",$userType);
		$q -> bindParam(":DOB",$dob);
		$q -> execute();
	}
				
	public function userValidation($emailAddr, $suppliedPass){
		$conn = $this -> getConnection();
		$getQuery = "SELECT fname, lname, email, pword, userID FROM newuser WHERE email = :emailAddr";
		$q = $conn -> prepare($getQuery);
		$q -> bindParam(":emailAddr", $emailAddr);
		$q -> execute();
		$info = $q ->fetchAll();
		return reset ($info);
	}
	
	public function getCurrentUsers(){
		$conn = $this->getConnection();
		return $conn->query("SELECT email, fname, lname, userID FROM newuser");
	}
	
/*	public function getCurrentSongs($emailAddr){
		$conn = $this->getConnection();
		$getQuery = "SELECT songName, artist FROM song WHERE email = :email";
		$q = $conn -> prepare($getQuery);
		$q -> bindParam(":email", $emailAddr);
		$q -> execute();
		$info = $q -> fetchAll();
		return reset($info);
	}*/

		public function getCurrentSongs($emailAddr){
		$conn = $this->getConnection();
		//$getQuery = "SELECT songName, artist FROM song WHERE email = :email";
		return $conn->query("SELECT songName, artist FROM song WHERE email ='". $emailAddr."'");
	}

	public function getUserType($typeNumber){
		$conn = $this->getConnection();
		$getQuery = "SELECT userdID FROM newuser WHERE userID = :id";
		$q = $conn -> prepare($getQuery);
		$q -> bindParam(":id", $typeNumber);
		$q -> execute();
		$info = $q -> fetchAll();
		return reset($info);
	}

	public function saveSong($email,$songName,$artist){
		$conn = $this->getConnection();
			$saveQuery = 
			"INSERT INTO song (email,songName,artist)
			VALUES 
			(:email,:songName,:artist)";
		$q = $conn ->prepare($saveQuery);
		$q -> bindParam(":email",$email);
		$q -> bindParam(":songName",$songName);
		$q -> bindParam(":artist",$artist);
		$q -> execute();
	}
/*	
	public function deleteUser($id){
		$conn = $this->getConnection();
		$setDelete = "DELETE FROM users where id = :id";
		$q = $conn -> prepare($setDelete);
		$q -> bindParam(":id",$id);
		$q -> execute();
	}
	
	public function activateUser($id){
		$conn = $this->getConnection();
		$userStatus = 1;
		$setInactive = "UPDATE users SET user_status = :userstatus where id = :id";
		$q = $conn -> prepare($setInactive);
		$q -> bindParam(":id",$id);
		$q -> bindParam(":userstatus", $userStatus);
		$q -> execute();
	}*/

	
/*		public function getCurrentSongs($email){
		$conn = $this->getConnection();
		return $conn->query("SELECT artist, songName FROM song WHERE email= :email");
	}*/
	
			
}
