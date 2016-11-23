<?php
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['passwordCheck'])) {
		$error = "Username or Password is empty";
	}
	else{
		$username=$_POST['username'];
		$password=$_POST['password'];
		$passwordCheck =$_POST['passwordCheck'];
		
		//Check if passwords are the same	
		if($password != $passwordCheck) $error = "Passwords are not the same";
		else{

			$connection = mysql_connect("localhost", "root", "root");
			$db = mysql_select_db("warzone", $connection);

			// To protect MySQL injection for Security purpose
			$username = stripslashes($username);
			$password = stripslashes($password);

			$username = mysql_real_escape_string($username);
			$password = mysql_real_escape_string($password);

			$query = mysql_query("select * from login where username='$username'", $connection);
			$rows = mysql_num_rows($query);

			if($rows > 0) $error = "Username is taken";
			else{
				$q = mysql_query("insert into login (username, password,loggedinTime) values ('$username', '$password', NULL)", $connection);
				if($q){
					echo '<script language="javascript">';
					echo 'alert("Signup Successful")';
					echo '</script>';
					redirect(); 
				}
				else{
					echo '<script language="javascript">';
					echo 'alert("Signup Unsuccessful")';
					echo '</script>';
					refresh();
				}
			}
		}
	}
}
function redirect(){
	header('Location: index.php');
}
function refresh(){
	header("Refresh:0");
}
?>