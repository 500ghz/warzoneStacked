<?php

include('signin.php');

if(isset($_SESSION['login_user'])){
	header("location: home.php");
}

?>


<html>
<head>
	<title>Warzone Signup</title>
	<link rel="stylesheet" href="warzone.css">
</head>

<body>
	<div class = "form">
		<h1>Signup to the Warzone!!!</h1>
		
		<div id = "login">
			
			<form action = "" method = "post">
				
				<input id = "name" name = "username" placeholder = "Username" type = "text"> <br/><br/>
				<input id = "password" name = "password" placeholder = "Enter Password" type = "password"> <br/> <br/>
				
				<input id="passwordCheck" name = "passwordCheck" placeholder = "Re-Enter Password" type = "password"> <br/> <br/>
				<input name = "submit" type = "submit" value = " Sign Up! ">
				
				<p id="error">
				<span>
					<?php 
					echo $error; 
					?>
				</span>
				</p>
			</form>
		</div>
	</div>
</body>
</body>
</html>