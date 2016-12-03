<?php

	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$connection = mysql_connect("localhost", "root", "");
	// Selecting Database
	$db = mysql_select_db("warzone", $connection);

	// Starting Session
	session_start();

	// Storing Session
	$user_check = $_SESSION['login_user'];

	// SQL Query To Fetch Complete Information Of User
	$ses_sql = mysql_query("select username from login where username='$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session = $row['username'];

	// SQL Query To Fetch Complete Information Of User
	$ses_sql1 = mysql_query("select * from login where username='$user_check'", $connection);
	$row1 = mysql_fetch_assoc($ses_sql1);
	$login_session1 = $row1['sessionID'];

	if(!isset($login_session)){
		
		// Closing Connection
		mysql_close($connection); 
		
		// Redirecting To Home Page
		header('Location: index.php'); 
	}
	
?>