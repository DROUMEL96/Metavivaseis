<?php

	session_start();
	
	include('header.php');	
	
	if(!isset($_SESSION['role'])){
		header("Location: login.php");
	}
	
	
	if(isset($_POST['submit'])){
		//create metavivasi
		
		$data = ["fname"=>$_POST["fname"], "lname"=>$_POST['lname'], "afm"=>$_POST['afm'],
		"email"=>$_POST['email'], "password"=> $_POST['password'], "role" =>(int)$_POST["role"]];
		$new_user = json_encode($data);
		
		$base = "127.0.0.1:8080";
		$point = "/user/add";
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
		curl_setopt($ch,CURLOPT_POSTFIELDS, $new_user);

		//So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

		//execute post
		$result = curl_exec($ch);
		echo $result;
		//header('Location: users.php');
	}else{
	
	
	//get users
	$result = file_get_contents("http://127.0.0.1:8080/diefthinsimetaforon/all");
	
	$dm_all = json_decode($result, true);
	
	
	?>
	<br>
	<form method="POST">
		Name:<br>
		<input type="text" name="fname">
		<br>
		Surname:<br>
		<input type="text" name="lname">
		<br>
		AFM:<br>
		<input type="text" name="afm">
		<br>
		Email:<br>
		<input type="text" name="email">
		<br>
		Password:<br>
		<input type="text" name="password">
		<br>
		Role:<br>
		<select name="role">
			<option value="1">User</option>
			<option value="2">Admin</option>
		</select>
		<br>
		
		<input type='submit' name='submit' value='Create'>
	</form>
	
	<?php
	}//end else
	
	include('footer.php');
?>

