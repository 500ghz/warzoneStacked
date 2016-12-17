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
	<link rel="stylesheet" href="warzone.css">
</head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>

//function that gets a list of active players
function load_data(){
	$.ajax({
		url: "getplayers.php",
		data: {action: 'get'},
		type: 'post',
		cache: false,
		success: function(data){
			$("#player_list").html(data);
		} 
	});
}

function load_invites(){
	$.ajax({
		url: "getplayers.php",
		data: {action: 'invites'},
		type: 'post',
		cache: false,
		success: function(data){
			username = data;
			if(data == ''){
			}
			else{
				confirm_yes = confirm(data+" invited you to a game. Accept ?");
				if(confirm_yes == true){
					window.location.href="Board.php";
					accept_invite(username);
				}
				else{
					deny_invite();
				}
			}
		}
	});
}

function accept_invite(username){
	$.ajax({
		url: "getplayers.php",
		data: {action: 'response', username: username},
		type: 'post',
		success: function(){
		}
	});
}

//removes username 
function deny_invite(){
	$.ajax({
		url: "getplayers.php",
		data: {action: 'cancel'},
		type: 'post',
		success: function(){
		}
	});
}

//refreshes page every 10 seconds
function reload(){
	load_data();
	load_invites();
	window.location.reload(true);
}

//stuff to update everytime
$(document).ready(function(){

//Calls database tosee if new users logged in
load_data();

//Button click code that generates first invite
$('.container').on('click', 'button', function get_username(){
	var $e = $(this);
	var b_id = $e.data("param").split('-')[1];
	var username = $("td#"+b_id).text();
	$.ajax({
		type: "POST",
		url: "getplayers.php",
		data: {action: 'username', username: username},
		success: function(data) {
			console.log(data);
		}
	});
});
});

//Refresh load_data() function after 10000 milliseconds
setInterval(reload,10000);

</script>
<body>

	<center>
		<div id = "profile">
			<h1><b id = "welcome"> Welcome to the Warzone!!!! </b></h1>
			<div id = "Userlogged_in">
			</div>
			<br/>
			<form action = "logout.php" method = "post">
				<button class="button1">Log Out</button>
			</form>
		</div>
		<section class="container">
			<div id = "player_list"></div>
		</section>
	</center>
</body>
</html>