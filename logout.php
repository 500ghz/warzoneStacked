<?php

	// Starting Session
	session_start();
	$user_check = $_SESSION['login_user'];
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$connection = mysql_connect("localhost", "root", "");
	// Selecting Database
	$db = mysql_select_db("warzone", $connection);

	// SQL Query To Fetch Complete Information Of User
	$ses_sql = mysql_query("UPDATE login SET sessionID = '' WHERE username ='$user_check'", $connection);
	
	
	
	// Destroying All Sessions
		if(session_destroy()) {
			
			// Redirecting To Home Page
			header("Location: index.php"); 
		}
?>
