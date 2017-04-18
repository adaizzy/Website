<?php
//session_start();
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
			<h1 class="topbar">Tunes to Sing</h1
			
		</div>
		
		<div id="leftbar">
			<a href=""><h3>main</h3></a>
			<a href="./index.php"><h3>about</h3></a>
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
					<a href="./reguser.php"><h3 id="nav">User Page</h3></a>
				<?php } ?>
			<?php } ?>
			
			<div id="rightbar">
				<?php if(isset($_SESSION['UserName'])) { 
				?> Welcome, <?php echo htmlspecialchars($_SESSION['UserName']); 
				} ?>
			</div>
		</div>
		
		<div class="textbody">
			<div class="testing">
				<?php if(isset($_SESSION['Type'])){ 
					if ($_SESSION['Type'] == 2 || $_SESSION['Type'] == 1) {?>
						<ul>
							<?php foreach ($upimages as $upimage) { ?>
								<form action="deleteimage.php" method="post">
								<?php if(substr($upimage['filename'],0,1)=="/"){
									$foo = substr($upimage['filename'],1);
								} else {
									$foo = $upimage['filename'];
								}
								$filstr = explode("/",$foo);
								echo "<li><a data-imgname=" . end($filstr) ." href='detail.php?id=" . $upimage['id'] . "'>" .
							end($filstr). "</a>"; ?>
							
							<?php if($_SESSION['Type'] == 2){ ?>
							<input type="hidden" name="imgDelete" value="<?php echo $upimage['id'] ?>" >
							<input type="submit" name="imgdelete" value="Delete">
							<?php } ?>
							</form> </li><?php
							} ?>
						</ul>
				<?php } elseif($_SESSION['Type'] == 3){ ?>
					<h2>As a guest account, you are restricted from viewing this page.</h2>
				<?php } else {
					header("location:notloggedin.php");
				} 
			} else {
				header("location:notloggedin.php");
			}?>	
				</div>
				<div class="popup" ></div>
		</div>
		
		<div id="footer">
			<footer>
				<hr>
				&copy Amber Louie, 2017
			</footer>
		</div>

	</body>
</html>