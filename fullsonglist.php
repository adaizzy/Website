<?php
  require_once "Dao.php";
  $dao = new Dao();
  
?>
<html>
	<head>
		<link rel="stylesheet" href="mystylesheet.css">
		<link rel="shortcut icon" href="favicon.ico" />
		<style>
		table, td, th {
			border: 2px solid black;
		}

		table {
			border-collapse: collapse;
			width: 75%;
		}

		th {
			height: auto;
		}
		</style>
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
			<?php if(isset($_SESSION['isLoggedIn'])){ ?>
				<a href="./addsong.php"><h3>Add Song</h3></a>
				<a href="./logout.php"><h3>Log Out</h3></a>
			<?php } ?>
		</div>
		
		<div class="textbody">
		<div align='center'>
			<h2 id="congrats"><br>
			<?php if(isset($_SESSION['emailLogin'])) { ?>
				<h1 class="fulltable">Full Song List</h1>
				<?php
					$currentSongs = $dao->getCurrentSongs($_SESSION['emailLogin']);
				?>
					<table class="admin">
					<tr><h2>
					<td style="padding:15px 0 10px;">Song Name</td>
					<td style="padding:15px 0 10px;">Artist</td>
					</h2></tr>
					
					<?php foreach ($currentSongs as $currentSong) { ?>

					<tr><h2>
					<td><?php echo htmlspecialchars($currentSong['songName']); ?></td>
					<?php
					?>
					<td><?php echo htmlspecialchars($currentSong['artist']); ?></td>
					<?php 
					?>					
					<?php } ?>
					</table>
			<?php } ?>
			</h2><tr>
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