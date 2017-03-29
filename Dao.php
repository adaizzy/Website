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
	
	public function savenewuser($firstname,$lastname,$password1,$email,$dob){
		$conn = $this -> getConnection();
		$passwordHashed = password_hash($password1, PASSWORD_DEFAULT);
		$userStatus = 1;
		$userType = 3;
		$saveQuery = 
			"INSERT INTO users (fname,lname,pword, user_type, email,dob)
			VALUES 
			(:first_name,:last_name,:user_pass,:user_status,:user_type,:email,:dob)";
		$q = $conn ->prepare($saveQuery);
		$q -> bindParam(":fname",$firstname);
		$q -> bindParam(":lname",$lastname);
		$q -> bindParam(":pword",$passwordHashed);
		$q -> bindParam(":user_type",$userType);
		$q -> bindParam(":email",$email);
		$q -> bindParam(":dob",$dob);
		$q -> execute();
	}
	
	public function userValidation($emailAddr, $suppliedPass){
		$conn = $this -> getConnection();
		$getQuery = "SELECT id, first_name, email, user_pass, user_status, user_type FROM users WHERE email = :emailAddr";
		$q = $conn -> prepare($getQuery);
		$q -> bindParam(":emailAddr", $emailAddr);
		$q -> execute();
		$info = $q ->fetchAll();
		return reset ($info);
	}
	
	public function getCurrentUsers(){
		$conn = $this->getConnection();
		return $conn->query("SELECT id, first_name, last_name, user_status, user_type, email FROM users");
	}
	
	
	public function getUserType($typeNumber){
		$conn = $this->getConnection();
		$getQuery = "SELECT description FROM user_type WHERE id = :id";
		$q = $conn -> prepare($getQuery);
		$q -> bindParam(":id", $typeNumber);
		$q -> execute();
		$info = $q -> fetchAll();
		return reset($info);
	}
	
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
	}
}
