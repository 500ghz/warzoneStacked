<?php
include('session.php');

if (isset($_POST['btnLogin'])) {
	authenticateUser($_POST['txtUsername'], $_POST['txtPassword']);
}
$session = session_id();

?>

<html>
<head>
	<title>Warzone Home</title>
</head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
function something(){

	$.ajax({ url: 'getplayers.php',
		data: {action: 'test'},
		type: 'post',
		success: function(output) {
			console.log(output);
			replaceDiv(output);
		},
		error: function(output) {
			console.log(output);
					//console.log("Details: " + desc + "\nError:" + err);
				}
			});
}
function replaceDiv(output){
	document.getElementById("Omar").innerHTML = output;

}
</script>
<body>
	<div id = "profile">
		<b id = "welcome"> Welcome to the Warzone!!!! </b>
		
		<div id = "Userlogged_in">

		</div>
		
		<br/>
		<form action = "logout.php" method = "post">
			<button>Log Out</button>
		</form>
		<a href = "getplayers.php">this</a>
		<button onclick="something()">Button</button>
		
	</div>
	<div id = "Omar">Content</div>
</body>
</html>