<?php

require_once "Dao.php";
$dao = new Dao();



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
	
	if(empty($info['email'])){
		$info['email'] = "";
	}
	
	if(password_verify($_POST['passwordCheck'], $info['pword'])){
		echo 'valid';
		$_SESSION['user_status']=1;
	} else{
		echo 'invalid';
	}
	
	if(strcmp($info['email'],$_POST['emailLogin']) == 0  && password_verify($_POST['passwordCheck'], $info['pword'])){
		
		$_SESSION['UserName'] = $info['fname'];
		$_SESSION['Type'] = $info['userID'];
		if($info['user_status'] == 2 ){
			header("location:./addsong.php");
		}
		if($info['userID'] == 2 && $_SESSION['user_status'] == 1){
			$_SESSION['isLoggedIn']= true;
			$_SESSION['userID'] = 2;
			header("location:./admin.php");
		} elseif ($info['userID'] == 1 && $_SESSION['user_status'] == 1){
			$_SESSION['isLoggedIn']= true;
			$_SESSION['userID'] = 1;
			header("location:./reguser.php");
		} elseif ($info['userID'] == 3 && $_SESSION['user_status'] == 1){
			$_SESSION['isLoggedIn']= true;
			$_SESSION['userID'] = 3;
			header("location:./addsong.php");
		}
	 
	}else {
		header("location:./addsong.php");
		}
?>