<?php

require_once "Dao.php";
$dao = new Dao();

//session_start();
$missingEmail = false;
$missingPassword = false;
$_SESSION['emailLoginCheck'] = false;
$_SESSION['passwordloginCheck'] = false;
$_SESSION['isLoggedIn']= false;
$validation = true;
$auth = true;

$_SESSION=$_POST;

	if(empty($_POST['emailLogin'])){
		$missingEmail = true;
		$_SESSION['emailLoginCheck'] = $missingEmail;
		$validation = false;
	}
	
	if(empty($_POST['passwordCheck'])){
		$missingPassword = true;
		$_SESSION['passwordMissing'] = $missingPassword;
		$validation = false;
	}
	
	if($missingEmail == false && $missingPassword == false ){
		$auth = false;
		$_SESSION['sessionAuth'] = $auth;
	}
	
	$info = $dao -> userValidation($_POST['emailLogin'], $_POST['passwordCheck']);
	

	
	//print_r($info);
	
	if(empty($info['email'])){
		$info['email'] = "";
	}
	
	if(password_verify($_POST['passwordCheck'], $info['user_pass'])){
		echo 'valid';
	} else{
		echo 'invalid';
	}
	if(strcmp($info['email'],$_POST['emailLogin']) == 0  && password_verify($_POST['passwordCheck'], $info['user_pass'])){
		
		$_SESSION['UserName'] = $info['first_name'];
		$_SESSION['Type'] = $info['user_type'];
		}
		
		//print_r ($info);
			
		if($info['user_type'] == 2 && $info['user_status'] == 1){
			$_SESSION['isLoggedIn']= true;
			$_SESSION['usertype'] = 2;
			header("location:./admin.php");
		} elseif ($info['user_type'] == 1 && $info['user_status'] == 1){
			$_SESSION['isLoggedIn']= true;
			$_SESSION['usertype'] = 1;
			header("location:./reguser.php");
		} elseif ($info['user_type'] == 3 && $info['user_status'] == 1){
			$_SESSION['isLoggedIn']= true;
			$_SESSION['usertype'] = 3;
			header("location:./addsong.php");
		}
		
 	else {
		header("location:./addsong.php");
	}
?>