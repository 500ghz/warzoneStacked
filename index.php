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
	
		<div class="form">
		<h1>Welcome to the Warzone!!!</h1>
		
			
			<div id = "login">
				
				<form action = "" method = "post">
					
					
					<input id = "name" name = "username" placeholder = "Username" type = "text"> <br/><br/>
					
					
					<input id = "password" name = "password" placeholder = "Password" type = "password"> <br/><br/> 
					
					<input id="login" name = "submit" type = "submit" value = " Login "class="button1">
					
					<br />
					<br />
					<a href = "signup.php" class="button2">Or register now!</a>
					
					<br />

					<p>
					<span id="error">
						<?php 
						echo $error; 
						?>
					</span>
					</p>
				</form>

			</div>
		</div>
	
</body>
</html>