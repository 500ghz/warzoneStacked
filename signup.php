<?php

include('signin.php');

if(isset($_SESSION['login_user'])){
	header("location: home.php");
}

?>


<html>
<head>
	<title>Warzone Signup</title>
	
</head>

<body>
	<div id = "main">
		<h1>Signup to the Warzone!!!</h1>
		
		<div id = "login">
			
			<form action = "" method = "post">
				
				<label>Username :</label>
				<input id = "name" name = "username" placeholder = "username" type = "text"> <br/><br/>
				<label>Password :</label>
				<input id = "password" name = "password" placeholder = "**********" type = "password"> <br/> <br/>
				<label>Re-enter Password :</label>
				<input id="passwordCheck" name = "passwordCheck" placeholder = "**********" type = "password"> <br/> <br/>
				<input name = "submit" type = "submit" value = " Sign Up! ">

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