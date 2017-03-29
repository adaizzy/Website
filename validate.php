<?php

require_once "Dao.php";
$dao = new Dao();

session_start();
$missingEmail1 = false;
$missingEmail2 = false;
$missingPassword1 = false;
$missingPassword2 = false;
$_SESSION['emailMismatch'] = false;
$_SESSION['passwordMismatch'] = false;
$totalValidation = true;
$_SESSION['emailFormat'] = false; 

    $_SESSION=$_POST;
	if(empty($_POST['firstname'])){
		$_SESSION['fNameMissing'] = true;
		$totalValidation = false;
	}
	if(empty($_POST['lastname'])){
		$_SESSION['lNameMissing'] = true;
		$totalValidation = false;
	}
	if(empty($_POST['dob'])){
		$_SESSION['dobMissing'] = true;
		$totalValidation = false;
	}
	if(empty($_POST['email1'])){
		$missingEmail1 = true;
		$_SESSION['email1Missing'] = $missingEmail1;
		$totalValidation = false;
	}
	if(empty($_POST['email2'])){
		$missingEmail2 = true;
		$_SESSION['email2Missing'] = $missingEmail2;
		$totalValidation = false;
	}
	if(empty($_POST['password1'])){
		$missingPassword1 = true;
		$_SESSION['password1Missing'] = $missingPassword1;
		$totalValidation = false;
	}
	if(empty($_POST['password2'])){
		$missingPassword2 = true;
		$_SESSION['password2Missing'] = $missingPassword2;
		$totalValidation = false;
	}
	if ($missingEmail1 != true && $missingEmail2 != true){
		if(strcmp($_SESSION['email1'],$_SESSION['email2']) != 0){
			$_SESSION['emailMismatch'] = true;
			$totalValidation = false;
		}
	}
	if ($missingPassword1 != true && $missingPassword2 != true){
		if(strcmp($_SESSION['password1'],$_SESSION['password2']) != 0){
			$_SESSION['passwordMismatch'] = true;
			$totalValidation = false;
		}
	}
	
	if (!filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL)) {
		$_SESSION['emailFormat'] = true; 
		$totalValidation = false;
	}
	

	//print_r ($_SESSION);

	if ($totalValidation == false){
		header("location:./newuser.php");
		
	} else {
		$dao -> saveNewUser($_POST['firstname'],$_POST['lastname'],$_POST['password1'], $_POST['email1'],$_POST['dob']);
		header("location:./congrats.php");
	}
?>