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
	<link rel="stylesheet" href="warzone.css">
	
	<script>
	</script>
	
</head>

<body>
	<div id = "main">
		<div class="form">
		<h1>Welcome to the Warzone!!!</h1>
		
			
			<div id = "login">
				
				<form action = "" method = "post">
					
					
					<input id = "name" name = "username" placeholder = "username" type = "text"> <br/><br/>
					
					
					<input id = "password" name = "password" placeholder = "password" type = "password"> <br/><br/> 
					<input name = "submit" type = "submit" value = " Login "class="button1">
					
					
					<a href = "signup.php" class="button2">Register</a>
					
					<br />

					<span id="error">
						<?php 
						echo $error; 
						?>
					</span>
				</form>

			</div>
		</div>
	</div>
</body>
</html>