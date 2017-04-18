<?php
session_start();

?>
<html>
	<head>
		<link rel="stylesheet" href="mystylesheet.css"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="fade.js"></script>
	</head>
	
	<body>
		<div id="topfloatbar">
			<a href="">
				<img src="favicon.png" align=left>
			</a>
			<h1 class="topbar">Tunes to Sing</h1>
			
		</div>
		
		<div id="leftbar">
		<a href="index.php"><h3>home</h3></a>
			<?php if(!isset($_SESSION['isLoggedIn'])){ ?>
				<a href="./login.php"><h3 id="nav">login</h3></a>
			<?php } ?>
			<?php if(isset($_SESSION['Type'])){ 
				if ($_SESSION['Type'] == 2) {?>
					<a href="./admin.php"><h3>admin</h3></a>	
				<?php } ?>
			<?php } ?>
			<?php if(isset($_SESSION['Type'])){ 
				if ($_SESSION['Type'] == 2 || $_SESSION['Type'] == 1) {?>
					<a href="./reguser.php"><h3>User Page</h3></a>
					<a href="./addsong.php"><h3>upload song</h3></a>
				<?php } ?>
			<?php } ?>
			
			</div>
			
			<div id="rightbar">
				<?php if(isset($_SESSION['UserName'])) { 
				?> Welcome, <?php echo htmlspecialchars($_SESSION['UserName']); 
				} ?>
			</div>
		</div>
									
		<div class="textbody">
			<div  id="login" class="loginbox">
				<h1>Please enter login information below. <br></h1>
				<form method = "post" action="./existinguservalidation.php">
					<h2><label for="emailLogin">Email Address:</label> <input id="emailLogin" type="text" name="emailLogin" class="reguser" value=""/><br>
					<?php if(isset($_SESSION['emailLoginCheck'])){if($_SESSION['emailLoginCheck'] == true){?><span class="newuserpage">*Please enter a email address</span> <?php }} ?><br>
					<label for="passwordCheck">Password: </label> <input id="passwordCheck" type="password" name="passwordCheck" class="reguser" value=""/><br></h2>
					<?php if(isset($_SESSION['passwordMissing'])){if($_SESSION['passwordMissing'] == true){?> <span id="fadeinout" class="newuserpage">*Please enter a password</span> <?php }} ?>
					<?php if(isset($_SESSION['sessionAuth'])){if($_SESSION['sessionAuth'] == false){?> <span id="fadeinout" class="newuserpage">*Email or Password is incorrect</span> <?php }} ?><br></h2>
					<input type="submit" name="loginCheck" value="Login"/>
				</form>
				<hr>
				To create a new account, please click on new user link below.<br>
				<a href="./newuser.php">New User</a>
			</div>
		</div>

		<div id="footer">
			<footer>
				<hr>
				&copy Amber Louie, 2017
			</footer>
		</div>

	</body>	
</html>	