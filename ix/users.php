<?php

	session_start();
	
	include('header.php');	
	
	if(!isset($_SESSION['role'])){
		header("Location: login.php");
	}
	
	if(isset($_POST['delete'])){
		
		$base = "127.0.0.1:8080";
		$point = "/user/delete/".$_POST['id'];
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
		

		//So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

		//execute post
		$result = curl_exec($ch);
		
		echo '<br>Data Deleted!<br><br>';
		
	}
	
	
	//get users
	$result = file_get_contents("http://127.0.0.1:8080/user/all");
	
	$data = json_decode($result, true);
	
	
	
	echo '<a href="new_user.php">New User</a><br>';
	echo '<table class="mytable"><tr><th>ID</th><th>Name</th><th>Surname</th><th>AFM</th><th>Email</th><th>Role</th><th>Action</th></tr>';
	foreach($data as $d){
			echo "<tr><td>{$d['id']}</td><td>{$d['fname']}</td><td>{$d['lname']}</td><td>{$d['afm']}</td><td>{$d['email']}</td><td>{$d['role']}</td><td>";
		
			$action = '';
			if($d['role'] != 2){
				$action = "<form method='POST'><input type='hidden' name='id' value='{$d['id']}'><input type='submit' name='delete' value='Delete'></form>";
			}
			echo $action;
			
		
		echo "</td></tr>";
	}
	echo '</table>';
	
	
	include('footer.php');
?>

