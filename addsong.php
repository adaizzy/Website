<?php
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
			<h1 class="topbar">Tunes to Sing</h1>
			<?php if(isset($_SESSION['UserName'])) { 
				?> Welcome, <?php echo htmlspecialchars($_SESSION['UserName']); 
				} ?>
			
		</div>
		
		<div id="leftbar">
			<a href="./index.php"><h3>Main</h3></a>
			<?php if(isset($_SESSION['isLoggedIn'])){ ?>
				<a href="./addsong.php"><h3>Add Song</h3></a>
				<a href="./fullsonglist.php"><h3>Full Song List</h3></a>
				<a href="./logout.php"><h3>Log Out</h3></a>
			<?php } ?>
		</div>
		
		<div class="textbody">
			
			<?php if(isset($_SESSION['isLoggedIn'])){ ?>
				<?php if($_SESSION['Type'] == 2 || $_SESSION['Type'] == 3) { ?>
					<form method="post" action="./insert.php">
						<div>
						<h2><label for="songName">Song Name:</label> <input id="songName" type="text" name="songName" class="song" value="<?php if(isset($_SESSION['songName'])){echo $_SESSION['songName'];} ?>">
							<br>
							<br>
					 	    <label for="artist">Artist:</label><input id="artist" type="text" name="artist" class="song" value="<?php if(isset($SESSION['artist'])){echo $_SESSION['artist'];} ?>">
							 <input type="hidden" name="email" type="text" class="song" value="<?php echo $_SESSION['emailLogin'] ?>">
						</div>
						<div class="centerSubmit">
						  <input type="submit" name="Submit" value="Submit">
						</div>
					</form>	
				<?php } elseif($_SESSION['Type'] == 1) { ?>
					<h2 class="centertext">Currently you are unable to put a song in.</h2>
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