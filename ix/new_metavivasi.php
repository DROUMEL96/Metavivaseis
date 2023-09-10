<?php

	session_start();
	
	include('header.php');	
	
	if(!isset($_SESSION['role'])){
		header("Location: login.php");
	}
	
	
	if(isset($_POST['submit'])){
		//create metavivasi
		
		$data = ["seller_id"=>(int)$_SESSION['id'], "buyer_afm"=>$_POST['buyer_afm'], 
		"car_label"=>$_POST['car_label'], "dm_id"=>(int)$_POST['DM_id']];
		
		$new_metavivasi= json_encode($data);
		
		$base = "127.0.0.1:8080";
		$point = "/metavivasi/add";
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
		echo $result;
		echo '<br>Data saved!<br><br>';
	}else{
	
	
	//get users
	$result = file_get_contents("http://127.0.0.1:8080/diefthinsimetaforon/all");
	
	$dm_all = json_decode($result, true);
	
	
	?>
	<br>
	<form method="POST">
		Buyer AFM:<br>
		<input type="text" name="buyer_afm">
		<br>
		Car plate:<br>
		<input type="text" name="car_label">
		<br>
		Diefthinsi_metaforon:<br>
		<select name="DM_id">
		<?php
			//select lawers:
			foreach($dm_all as $dm){
				echo "<option value='{$dm['id']}'>{$dm['title']}</option>";
			}
		?>
		</select>
		<br>
		<input type='submit' name='submit' value='Create'>
	</form>
	
	<?php
	}//end else
	
	include('footer.php');
?>

