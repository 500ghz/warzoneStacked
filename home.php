<?php
include('session.php');

if (isset($_POST['btnLogin'])) {
	authenticateUser($_POST['txtUsername'], $_POST['txtPassword']);
}
$session = session_id();
echo $session;

?>


<!DOCTYPE html>
<html>
<head>
	<title>Warzone Home</title>
</head>

<body>
	<div id = "profile">
		<b id = "welcome"> Welcome to the Warzone!!!! </b>
		
		<div id = "Userlogged_in">

			<?php 
			echo $login_session;
			?>

		</div>
		
		<br/>
		<form action = "logout.php" method = "post">
			<button>Log Out</button>
		</form>
	</div>
</body>
</html>