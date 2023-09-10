<?php

	session_start();
	
	include('header.php');	
	
	if(!isset($_SESSION['role'])){
		header("Location: login.php");
	}
	
	$id = $_GET['id'];
	
	if(isset($_POST['submit'])){
		//update metavivasi
		
		//get metavivasi
		$result = file_get_contents("http://127.0.0.1:8080/metavivasi/get/".$id);
		
		$data = json_decode($result, true);
		
		$data['accepted'] = 1; //update agree
		
		$new_metavivasi = json_encode($data);
		
		$base = "127.0.0.1:8080";
		$point = "/metavivasi/edit/".$id;
		$url = $base.$point;

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		$headers = array(
		   "Content-Type: application/json",
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $new_metavivasi);

		//So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

		//execute post
		$result = curl_exec($ch);
		
		echo '<br>Data updated!<br><br>';
	}
	
	
	//get metavivasi
	$result = file_get_contents("http://127.0.0.1:8080/metavivasi/get/".$id);
	
	$d = json_decode($result, true);
	
	
	$no_yes = ['No','Yes'];
	
	echo '<table class="mytable"><tr><th>ID</th><th>Seller</th><th>Buyer</th><th>Car plate</th><th>DM id</th><th>Accept</th></tr>';
	
	echo "<tr><td>{$d['id']}</td><td>{$d['seller_id']}</td><td>{$d['buyer_afm']}</td><td>{$d['car_label']}</td><td>{$d['dm_id']}</td><td>{$no_yes[$d['accepted']]}</td>";
		
	echo '</table>';
	
	//if agree is no, show button
	if($d['accepted'] == 0){
	?>
	
	<form method="POST" action="accept.php?id=<?php echo $_GET['id']?>">
		<input type='submit' name='submit' value='Accept'>
	</form>
	
	<?php
	}
	
	include('footer.php');
?>

