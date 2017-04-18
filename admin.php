<?php

require_once "Dao.php";
$dao = new Dao();
?>
<html>
	<head>
		<link rel="stylesheet" href="mystylesheet1.css">
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		<div id="topfloatbar">
			<a href="">
				<img src="favicon.png" align=left>
			</a>
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
			<h1 class="topbar">Tunes to Sing</h1>
			
		</div>

		<div id="leftbar">
			<a href="./index.php"><h3>main</h3></a>
			<?php if(!isset($_SESSION['isLoggedIn'])){ ?>
				<a href="./login.php"><h3>login</h3></a>
			<?php } ?>
			<?php if(isset($_SESSION['Type'])){ 
				if ($_SESSION['Type'] == 2) {?>
					<a href="./admin.php"><h3 id="nav">admin</h3></a>	
				<?php } ?>
			<?php } ?>
			<?php if(isset($_SESSION['Type'])){ 
				if ($_SESSION['Type'] == 2 || $_SESSION['Type'] == 3) {?>
					<a href="./logout.php"><h3>Log Out</h3></a>
				<?php } ?>
			<?php } ?>
			
			<div id="rightbar">
				<?php if(isset($_SESSION['UserName'])) { 
					?> Welcome, <?php echo htmlspecialchars($_SESSION['UserName']); 
				} else {?>
					Please login to view contents of this page
				<?php } ?>
			</div>
		</div>
		
		<div class="textbody">
		<div align='center'>
			<h2 id="congrats"><br>
			<?php if(isset($_SESSION['userID'])  && $_SESSION['userID'] == 2){ ?>
				<h1 class="tableheader">Current Users</h1>
				<?php
					$currentUsers = $dao->getCurrentUsers();
				?>

					<table class="admin">
					<tr><h2>
					<td style="padding:0 15px 0 10px;">First Name</td>
					<td style="padding:0 15px 0 10px;">Last Name</td>
					<td style="padding:0 15px 0 10px;">User Type</td>
					<td style="padding:0 15px 0 10px;">Email</td>
					</h2></tr>
					<?php foreach ($currentUsers as $currentUser) { 
					?>
					<tr><h2>
					<td><?php echo htmlspecialchars($currentUser['fname']); ?></td>
					<?php
					?>
					<td><?php echo htmlspecialchars($currentUser['lname']); ?></td>
					<?php 
					?>
					<td><?php echo htmlspecialchars($currentUser['userID']); ?></td>
					<?php 
					?>
					<?php 
					?></td>
					<td><?php echo htmlspecialchars($currentUser['email']); ?></td>
					<?php 
					 ?>
					
					<?php } ?>
					</table>
			<?php } else { ?>
					You are not authorized to view contents on this page.  Please login to access 
					the admin panel.
			<?php } ?></h2>
		</div>
		</div>
		
		<div id="footer">
			<footer>
				<hr width>
				&copy Amber Louie, 2017
				<!--<?php echo date("Y"); ?>-->
			</footer>
		</div>

	</body>
</html>
