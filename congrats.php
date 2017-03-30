<?php
session_start();
?>
<html>
	<head>
		<link rel="stylesheet" href="mystylesheet.css">
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		<div id="topfloatbar">
			<a href="">
				<img src="favicon.png" align=left>
			</a>
				<a href="">
				<img src="Login-Button-smaller.jpg" align=right>
				</a>
			<h1 class="topbar">Tunes to Sing</h1>
			
		</div>
		
		<div id="leftbar">
			<a href="./index.php"><h3>home</h3></a>
			<a href="./login.php"><h3>login</h3></a>
			<?php if(isset($_SESSION['Type'])){ 
				if ($_SESSION['Type'] == 2) {?>
					<a href="./admin.php"><h3>admin</h3></a>	
				<?php } ?>
			<?php } ?>
			<?php if(isset($_SESSION['Type'])){ 
				if ($_SESSION['Type'] == 2 || $_SESSION['Type'] == 3) {?>
					<a href="./reguser.php"><h3>User Page</h3></a>
					<a href="./addsong.php"><h3>Add Song</h3></a>
				<?php } ?>
			<?php } ?>
			
			<div id="rightbar">
				<?php if(isset($_SESSION['UserName'])) { 
				?> Welcome, <?php echo htmlspecialchars($_SESSION['UserName']); 
				} ?>
			</div>
		</div>
		
		<div class="textbody">

			<h2 id="congrats">Congrats account successfully created.</h2>
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