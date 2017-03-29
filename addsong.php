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
					<a href="./reguser.php"><h3>User Page</h3></a>
					<a href="./addsong.php"><h3 id="nav">upload image</h3></a>
				<?php } ?>
			<?php } ?>
			
			<div id="rightbar">
				<?php if(isset($_SESSION['UserName'])) { 
				?> Welcome, <?php echo htmlspecialchars($_SESSION['UserName']); 
				} ?>
			</div>
		</div>
		<?php print_r($_SESSION(['fname'])) ?>
		<div class="textbody">
			<?php if(isset($_SESSION['isLoggedIn'])){ ?>
				<?php if($_SESSION['usertype'] == 2 || $_SESSION['usertype'] == 1) { ?>
					<form method="post" action="upload.php" enctype="multipart/form-data">
						<div>
						  <form method="post" action = "validate.php">
						<h2><label for="songName">Song Name:</label> <input id="songName" type="text" name="SongName" class="song" value="<?php if(isset($_SESSION['songName'])){echo $_SESSION['songName'];} ?>">
						<?php if(isset($_SESSION['songNameMissing'])){if($_SESSION['songNameMissing'] == true){?> <span id="fadeinout" class="song">*Please enter a Song Name</span> <?php }} ?><br>
						<label for="artist">artist:</label> <input id="artist" type="text" name="artist" class="song" value="<?php if(isset($_SESSION['artist'])){echo $_SESSION['artist'];} ?>">
						  <?php } } ?>
						</div>
						<div class="centerSubmit">
						  <input type="submit" name="Submit" value="Submit">
						</div>
					</form>
				<?php } elseif($_SESSION['usertype'] == 1) { ?>
					<h2 class="centertext">Currently you are unable to upload.</h2>
				<?php } ?>
			<?php } else {?>
				<h2 class="centertext">You are currently not logged into the site. Please log into the site to gain access to the features of this web page.</h2>
			<?php } ?>
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