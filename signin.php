<?php
if (isset($_POST['submit'])) {
		if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['passwordCheck'])) {
		$error = "Username or Password is invalid";
		}
		else{
			$username=$_POST['username'];
			$password=$_POST['password'];
			$passwordCheck =$_POST['passwordCheck'];
		//Check if passwords are the same	
		if($password != $passwordCheck) $error = "Passwords are not the same";
		}
?>