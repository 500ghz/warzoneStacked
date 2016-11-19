<?php

	include('login.php'); 

	if(isset($_SESSION['login_user'])){
		header("location: home.php");
	}

?>

<!DOCTYPE html>

<html>
	<head>
		<title>Warzone Login</title>
	
	</head>
	
	<body>
		<div id = "main">
		<h1>Welcome to the Warzone!!!</h1>
		
		<div id = "login">
		
		<form action = "" method = "post">
		
			<label>Username :</label>
			<input id = "name" name = "username" placeholder = "username" type = "text"> <br/><br/>
			<label>Password :</label>
			
			<input id = "password" name = "password" placeholder = "**********" type = "password"> <br/> <br/>
			<input name = "submit" type = "submit" value = " Login ">

			<span>
				<?php 
					echo $error; 
				?>
			</span>
		</form>
		</div>
		</div>
	</body>
</html>