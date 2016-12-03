<?php

// Starting Session
session_start();

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else {

		function isLoginSessionExpired() {
			$login_duration = 1; 
			$current_time = time();
			if(loggedIn()) {
				$loggedintime = mysql_query("SELECT loggedin_time FROM login WHERE username='$username'", $connection);
				if(((time() - $loggedintime) > $login_duration)){ 
					return true; 
				}
			}
			return false;
		}

		function loggedIn(){
			// SQL query to fetch information of registerd users and finds user match.
			$loggedin = mysql_query("SELECT * FROM login WHERE password='$password' AND username='$username' AND loggedin_time = !NULL", $connection);
			$rows = mysql_num_rows($loggedin);

			if ($rows == 1) {
				return true;
			} else {
				return false;
			}

		}
		// In case of an error, use this var
		$error='';

		$username=$_POST['username'];
		$password=$_POST['password'];


// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect("localhost", "root", "");

// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);

		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);

// Selecting Database
		$db = mysql_select_db("warzone", $connection);
		// SQL query to fetch information of registerd users and finds user match.
		$query = mysql_query("SELECT * FROM login WHERE password='$password' AND username='$username'", $connection);
		$rows = mysql_num_rows($query);

		//Gets current time as int
		$time = time();
		
		//Query that adds loggedinTime to users table
		$query2 = mysql_query("UPDATE login SET loggedinTime = '$time' WHERE username ='$username'");

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