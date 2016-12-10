<?php
// Starting Session
session_start();
// In case of an error, use this var
$error='';
$session = session_id();

if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username or Password is invalid";
	}
	else {
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
		$sessionDB = mysql_fetch_assoc($query);
		$sessionID = $sessionDB['sessionID'];

		if ($rows == 1 && $sessionID == $session || $sessionID == '') {

			$query2 = mysql_query("UPDATE login SET sessionID = '$session' WHERE username ='$username'");
			
			// Initializing Session
			$_SESSION['login_user']=$username; 
			
			// Redirecting To Other Page
			header("location: home.php");
		} else if ($sessionID != $session){
			$link = "You are currently signed in please logout";
		echo "<script type='text/javascript'>alert('$link');</script>";

		}
		else{
			$error = "Username or Password is invalid ";
		}
			// Closing Connection
		mysql_close($connection);
	}
}
?>