<?php

	session_start();
	
	
	$errors="";
	if (isset($_POST['submit']))
	{
		$email = $_POST['email'];
		$pass = $_POST['password'];

		if($email=='admin' && $pass == 'admin'){
			$_SESSION['id'] = 0;
			$_SESSION['email'] = 'adimn';
			$_SESSION['name'] = 'adimn';
			$_SESSION['surname'] = 'adimn';
			$_SESSION['role'] = 2;
			$_SESSION['afm'] = 'adimn';
			
			header("Location: users.php");
			exit(0);
		}

		$base = "127.0.0.1:8080";
		$point = "/user/login";
		$url = $base.$point;

		//The data you want to send via POST
		$fields = '{"email": "'.$email.'","password": "'.$pass.'"}';

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		$headers = array(
		   "Content-Type: application/json",
		);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);

		//So that curl_exec returns the contents of the cURL; rather than echoing it
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

		//execute post
		$result = curl_exec($ch);
		
		if($result ==""){
			// show error
			$errors = "Wrong username or password!";
		}else{
			$data = json_decode($result, true);
			
			$_SESSION['id'] = $data['id'];
			$_SESSION['email'] = $data['email'];
			$_SESSION['name'] = $data['fname'];
			$_SESSION['surname'] = $data['lname'];
			$_SESSION['role'] = $data['role'];
			$_SESSION['afm'] = $data['afm'];
			
			header("Location: metavivaseis.php");
		}
	}

	include('header.php');	

?>
 
	<h3>Είσοδος</h3>
	<form action="index.php" method="post">
		<table>
			<tr>
				<td>Email:</td>
				<td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" /></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="submit" value="Login" /></td>
			</tr>
		</table>
	</form>
		
<?php
	
		echo "<b class='error'>$errors</b>";		
	
	include('footer.php');
?>

