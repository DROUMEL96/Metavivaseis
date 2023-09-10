<?php

	session_start();
	
	include('header.php');	
	
	if(!isset($_SESSION['role'])){
		header("Location: index.php");
	}
	
	//get metavivaseis
	$result = file_get_contents("http://127.0.0.1:8080/metavivasi/all");
	
	$data = json_decode($result, true);
	
	
	$no_yes = ['No','Yes'];
	
	echo '<table class="mytable"><tr><th>ID</th><th>Seller</th><th>Buyer</th><th>Car plate</th><th>Diefthinsi Metaforon</th><th>Agree</th><th>Action</th></tr>';
	foreach($data as $d){
		if($d['seller_id'] == $_SESSION['id']){
			echo "<tr><td>{$d['id']}</td><td>{$d['seller_id']}</td><td>{$d['buyer_afm']}</td><td>{$d['car_label']}</td><td>{$d['dm_id']}</td><td>{$no_yes[$d['accepted']]}</td><td>";
		}
		if($d['buyer_afm'] == $_SESSION['afm']){
			echo "<tr><td>{$d['id']}</td><td>{$d['seller_id']}</td><td>{$d['buyer_afm']}</td><td>{$d['car_label']}</td><td>{$d['dm_id']}</td><td>{$no_yes[$d['accepted']]}</td><td>";
		
			$action = '';
			if($d['accepted'] == 0){
				$action = "<a href='accept.php?id={$d['id']}'>Accept</a>";
				echo $action;
			}
			
		}
		echo "</td></tr>";
	}
	echo '</table>';
	
	

	
	
	
	include('footer.php');
?>

