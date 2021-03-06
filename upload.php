<?php

  require_once "Dao.php";
  $dao = new Dao();
  $_SESSION['fileNameSet'] = false;
  $_SESSION['fileError'] = false;
  $_SESSION['fileEnteredDescription'] = '';
  $_SESSION['fileEnteredName'] = '';
  
  //print_r($_POST);

  if($_SESSION['isLoggedIn'] == 1 && ($_SESSION['usertype'] == 2 || $_SESSION['usertype'] == 1)){

		
		if(isset($_POST['imagename'])){
			$name = $_POST['imagename'];
		} else {
			$_SESSION['fileNameSet'] = true;
			$name = '';
		}
		

      if(isset($_POST['imagedescription'])){
		  $description = $_POST['imagedescription'];
	  } else {
		  $description =  "";
	  }
	  $imagePath = "";
	  
	  //print_r($name);
	  //print_r($_SESSION['fileNameSet']);
	  
	  if(empty($name)){
		 $_SESSION['fileEnteredDescription'] = $description;
		 header("location:http://webdev/~gwirth/addimage.php");
	  } else {

		  if (count($_FILES) > 0) {
			if ($_FILES["file"]["error"] > 0) {
				$_SESSION['fileError']=true;
				$_SESSION['fileEnteredDescription'] = $description;
				$_SESSION['fileEnteredName'] = $name;
				header("location:http://webdev/~gwirth/addimage.php");
			  throw new Exception("Error: " . $_FILES["file"]["error"]);
			} else {
			  $basePath = "/home/students/gwirth/public_html";
			  $imagePath = "/uploadimages/" . $_FILES["file"]["name"];
			  if (!move_uploaded_file($_FILES["file"]["tmp_name"], $basePath . $imagePath)) {
				throw new Exception("File move failed");
			  }
			}
		  }
		
	  $dao->saveImage($name, $description, $imagePath);
	  header("location:http://webdev/~gwirth/addimage.php");
	  }
  } else {
	  header("location:http://webdev/~gwirth/notloggedin.php");
  }