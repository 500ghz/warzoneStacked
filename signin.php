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
		
		$connection = mysql_connect("localhost", "root", "root");
		$db = mysql_select_db("warzone", $connection);
		
		$query = mysql_query("select * from login where username='$username'", $connection);
		$rows = mysql_num_rows($query);
		
		if($row > 0) $error = "Username is taken";
		else{
			$q = mysql_query("insert into login (username, password) values ('$username', '$password')", $connection);
			header("Location: index.php"); 
		}
?>