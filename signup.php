<?php

	//include('signin.php');

?>


<html>
	<head>
		<title>Warzone Signup</title>
	
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
			<input id="passwordCheck" name = "passwordCheck" placeholder = "**********" type = "passwordCheck"> <br/> <br/>
			<input name = "submit" type = "submit" value = " signUp ">

			<span>
				<?php 
					echo $error; 
				?>
			</span>
		</form>
		</div>
		</div>
	</body>
	</body>
</html>