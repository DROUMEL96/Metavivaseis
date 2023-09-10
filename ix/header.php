<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">    
    <title>Εφαρμογή Μεταβίβασης Οχημάτων</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div id="container">
		<div id="header">
			<div id="logo">
				Εφαρμογή Μεταβίβασης
			</div>

			
			<ul class="menu">
				<?php
				if(isset($_SESSION['role']) && $_SESSION['role']==1){
				?>
						<li>
							<a href="metavivaseis.php">Μεταβιβάσεις</a>
						</li>
						<li>
							<a href="new_metavivasi.php">Νέα Μεταβίβαση</a>
						</li>
						<li>
							<a href="logout.php"> Έξοδος</a>
						</li>			
				<?php
				}else if(isset($_SESSION['role']) && $_SESSION['role']==2){
				?>
						<li>
							<a href="users.php">Χρήστες</a>
						</li>
						<li>
							<a href="logout.php"> Έξοδος</a>
						</li>			
				<?php					
				}else{
				?>
					<li>
						<a href="index.php">Είσοδος</a>
					</li>
				<?php
				}
				?>
				
				</ul>
		</div>	
		

	  
		<div id="mainContent">