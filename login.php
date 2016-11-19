<?php

	// Starting Session
session_start(); 
	// In case of an error, user this var
$error=''; 

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else {
		// Var $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];

		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "root");

		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);

		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);

		// Selecting Database
		$db = mysql_select_db("warzone", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
		$rows = mysql_num_rows($query);

		if ($rows == 1) {
			// Initializing Session
			$_SESSION['login_user']=$username; 
			
			// Redirecting To Other Page
			header("location: home.php"); 
		} else {
			$error = "Username or Password is invalid";
		}
			// Closing Connection
		mysql_close($connection); 
	}
}

?>