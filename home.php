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
function auto_load(){
	$.ajax({
		url: "getplayers.php",
		data: {action: 'test'},
		type: 'post',
		cache: false,
		success: function(data){
			$("#player_list").html(data);
		} 
	});
}

$(document).ready(function(){

auto_load(); //Call auto_load() function when DOM is Ready

$('.container').on('click', 'button', function get_username(){
	$.ajax({
		url: "getplayers.php",
		data: {action: 'blah'},
		type: 'post',
		cache: false,
		success: function(data){
			alert(data);
		} 
	});

});

});

//Refresh auto_load() function after 10000 milliseconds
setInterval(auto_load,10000);
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
		<!--<a href = "getplayers.php">this</a>
		<button onclick="something()">Button</button>-->
		
	</div>
	<section class="container">
	<div id = "player_list"></div>
	</section>
</body>
</html>