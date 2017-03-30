<?php

require_once "Dao.php";
$dao = new Dao();

//session_start();
	
	$dao -> activateUser($_POST['Active']);
	header("location:./admin.php");

?>