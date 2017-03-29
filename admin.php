<?php
session_start();
require_once "Dao.php";
$dao = new Dao();
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
			<a href="./index"><h3>main</h3></a>
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
					<a href="./reguser.php"><h3>User Page</h3></a>
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
			<h2 id="congrats"><br>
			<?php if(isset($_SESSION['Type'])  && $_SESSION['Type'] == 2){ ?>
				<h1 class="tableheader">Current Users</h1>
				<?php
					$currentUsers = $dao->getCurrentUsers();
				?>

					<table class="admin">
					<tr><h2>
					<td>First Name</td>
					<td>Last Name</td>
					<td>User Staus</td>
					<td>User Type</td>
					<td>Email</td>
					<td>Upgrage to Regular?</td>
					<td>Inactivate?</td>
					<td>Delete?</td>
					</h2></tr>
					<?php foreach ($currentUsers as $currentUser) { 
					$id = $currentUser['id']?>
					<tr><h2>
					<td><?php echo htmlspecialchars($currentUser['first_name']); ?></td>
					<td><?php echo htmlspecialchars($currentUser['last_name']); ?></td>
					<?php $userStatus = $dao -> getUserStatus($currentUser['user_status']) ?>
					<td><?php echo htmlspecialchars($userStatus['id_status']); ?></td>
					<?php $userType = $dao -> getUserType($currentUser['user_type']) ?>
					<td><?php echo htmlspecialchars($userType['description']); ?></td>
					<td><?php echo htmlspecialchars($currentUser['email']); ?></td>
					<td><form action="upgrade.php" method="post">
					<input type="hidden" name="Upgrade" value="<?php echo $id ?>">
					<input type="submit" name="upgrade" value="Upgrade"></form></td>
					<?php if($currentUser['user_status'] == 1){ ?>
						<td><form action="inactivate.php" method="post">
						<input type="hidden" name="Inactive" value="<?php echo $id ?>">
						<input type="submit" name="inactive" value="Inactivate"></form></td>
					<?php } else { ?>
						<td><form action="activate.php" method="post">
						<input type="hidden" name="Active" value="<?php echo $id ?>">
						<input type="submit" name="active" value="Activate"></form></td>
					<?php } ?>
					<td><form action="delete.php" method="post">
					<input type="hidden" name="UserID" value="<?php echo $id ?>">
					<input type="submit" name="delete" value="Delete"></form></td>
					</h2></tr>
					<?php } ?>
					</table>
			<?php } else { ?>
					You are not authorized to view contents on this page.  Please login to access 
					the admin panel.
			<?php } ?></h2>
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