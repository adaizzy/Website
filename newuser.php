<?php
	session_start();


?>
<html>
	<head>
		<link rel="stylesheet" href="mystylesheet.css">
		<link rel="shortcut icon" href="favicon.ico" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="fade.js"></script>
	</head>
	<body>
		<div id="topfloatbar">
			<a href="./index.php">
				<img src="favicon.png" align=left>
			</a>
			<?php if(!isset($_SESSION['isLoggedIn'])){ ?>
				<a href="./login.php">
				<img src="Login-Button-smaller.jpg" align=right>
				</a>
			<?php } else { 
				if ($_SESSION['isLoggedIn'] != 1) {?>
					<a href="./login.php">
					<img src="Login-Button-smaller.jpg" align=right>
					</a>
				<?php } else { ?>
					<a href="./logout.php">
					<img src="logout.jpg" align=right>
					</a>
				<?php } ?>
			<?php } ?>
			<h1 class="topbar">Tunes To Sing</h1>
			
		</div>
		
		<div id="leftbar">
		<a href=""><h3>main</h3></a>
			<?php if(!isset($_SESSION['isLoggedIn'])){ ?>
				<a href="./login.php"><h3>login</h3></a>
			<?php } ?>
			<?php if(isset($_SESSION['Type'])){ 
				if ($_SESSION['Type'] == 2) {?>
					<a href="./admin.php"><h3>admin</h3></a>	
				<?php } ?>
			<?php } ?>
			<?php if(isset($_SESSION['Type'])){ 
				if ($_SESSION['Type'] == 2 || $_SESSION['Type'] == 1) {?>
					<a href="./reguser.php"><h3>User Page</h3></a>
				<?php } ?>
			<?php } ?>
			
			<div id="rightbar">
				<?php if(isset($_SESSION['UserName'])) { 
				?> Welcome, <?php echo htmlspecialchars($_SESSION['UserName']); 
				} ?>
			</div>
			
			
		</div>
			<div class="textbody">
				<div  id="login" class="loginbox" >
					<h2>For new users, please fill in form below.  If you already have login credentials, please login by clicking either login button on the top or the link in the menu to the left.<br></h2>
				<div>
					<form method="post" action = "validate.php">
						<h2><label for="firstname">First Name:</label> <input id="firstname" type="text" name="firstname" class="newuser" value="<?php if(isset($_SESSION['firstname'])){echo $_SESSION['firstname'];} ?>">
						<?php if(isset($_SESSION['fNameMissing'])){if($_SESSION['fNameMissing'] == true){?> <span id="fadeinout" class="newuserpage">*Please enter a first name</span> <?php }} ?><br>
						<label for="lastname">Last Name:</label> <input id="lastname" type="text" name="lastname" class="newuser" value="<?php if(isset($_SESSION['lastname'])){echo $_SESSION['lastname'];} ?>">
						<?php if(isset($_SESSION['lNameMissing'])){if($_SESSION['lNameMissing'] == true){?> <span id="fadeinout" class="newuserpage">*Please enter a last name</span> <?php }} ?><br>
						<label for="dob">Date of birth: </label><input id="dob" type="date" name="dob" class="newuser" value="<?php if(isset($_SESSION['dob'])){echo $_SESSION['dob'];} ?>">
						<?php if(isset($_SESSION['dobMissing'])){if($_SESSION['dobMissing'] == true){?> <span id="fadeinout" class="newuserpage">*Please enter a date of birth</span> <?php }} ?><br>
						<label for="email1">Email address:</label> <input id="email1" type="text" name="email1" class="newuser" value="<?php if(isset($_SESSION['email1'])){echo $_SESSION['email1'];} ?>">
						<?php if(isset($_SESSION['email1Missing'])){if($_SESSION['email1Missing'] == true){?> <span id="fadeinout" class="newuserpage">*Please enter a email address</span> <?php }} ?><br>
						<label for="email2">Repeat Email address:</label> <input id="email2" type="text" name="email2" class="newuser" value="<?php if(isset($_SESSION['email2'])){echo $_SESSION['email2'];} ?>">
						<?php if(isset($_SESSION['email2Missing'])){if($_SESSION['email2Missing'] == true){?> <span id="fadeinout" class="newuserpage">*Please enter a email address</span> <?php }} ?>
						<?php if(isset($_SESSION['emailMismatch'])){if($_SESSION['emailMismatch'] == true){?> <span id="fadeinout" class="newuserpage">*Emails are not the same</span> <?php }} ?>
						<?php if(isset($_SESSION['emailFormat'])){if($_SESSION['emailFormat'] == true ){?> <span id="fadeinout" class="newuserpage">*Email is not in a proper format</span> <?php }} ?><br>
						<!--<label>Desired Username:</label> <input type="text" name="username" class="newuser"><br>-->
						<label for="password1">Password:</label> <input id="password1"type="password" name="password1" class="newuser" value="<?php if(isset($_SESSION['password1'])){echo $_SESSION['password1'];} ?>">
						<?php if(isset($_SESSION['password1Missing'])){if($_SESSION['password1Missing'] == true){?> <span id="fadeinout" class="newuserpage">*Please enter a password</span> <?php }} ?><br>
						<label for="password2">Repeat Password:</label> <input id="password2"type="password" name="password2" class="newuser" value="<?php if(isset($_SESSION['password2'])){echo $_SESSION['password2'];} ?>">
						<?php if(isset($_SESSION['password2Missing'])){if($_SESSION['password2Missing'] == true){?> <span id="fadeinout" class="newuserpage">*Please enter a password</span> <?php }} ?>
						<?php if(isset($_SESSION['passwordMismatch'])){if($_SESSION['passwordMismatch'] == true){?> <span id="fadeinout" class="newuserpage">*Passwords are not the same</span> <?php }} ?><br></h2>
						<input type="submit" name="newUserInfo" value="Create">
					</form>
					</div>
				</div>

			</div>


		<div id="footer">
			<footer>
				<hr>
				&copy Amber Louie, 2017
				<!--<?php echo date("Y"); ?>--> 
			</footer>
		</div>

	</body>
</html>