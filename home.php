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
			if(data == ""){
				alert(data);
			}
			else{
				//location.reload();
				confirm_yes = confirm(data+" invited you to a game. Accept ?");
				if(confirm_yes){
					window.location.href="Board.php";
				}
			}
		}
	});
}

//stuff to update everytime
$(document).ready(function(){

//Call load_data() function when DOM is Ready
load_data();
load_invites();
$('.container').on('click', 'button', function get_username(){
	var $e = $(this);
	var b_id = $e.data("param").split('-')[1];
	var username = $("td#"+b_id).text();
        // gets the id  of button
        $.ajax({
        	type: "POST",
        	url: "getplayers.php",
        	data: {action: 'username', username: username},
        	success: function(data) {
                // Hide the current clicked Button
                //$e.prop("disabled",true);
                //alert(data);
                console.log(data);
            }
        });
    });
});

//Refresh load_data() function after 10000 milliseconds

setInterval(load_data,10000);

function checkForInvitations(){

		// retrieve username from php session
		var invitedPlayer = '<?php echo $_SESSION["login_user"]; ?>'

		// send an ajax request
		$.ajax({
			type: "Post",
			url: "checkInvitations.php",
			data:{ invitedPlayer: invitedPlayer },
			success: function(data){
				// parse json string to javascript object
				var invitations = JSON.parse(data);
				
				// check the invitations to/from
				invitingPlayer = invitations.invitationFrom;
				invitationStatus = invitations.invitationStatus;
				
				if(invitationStatus!='false'){
					clearInterval(checkInvitationIntervalId);
					
					// javascript confirmation window
					confirm_yes = confirm(invitingPlayer+" invited you to a game. Accept ?");

					$.ajax({
						type: "Post",
						url: "respondToInvitation.php",
						data:{ invitedPlayer: invitedPlayer,
							invitingPlayer: invitingPlayer,
							decision: confirm_yes }, 
							success: function(data){
								if(confirm_yes){
									//go to game
								}else{
									pollForGameInvitations();
								}
							}
						});
				}
			}
		});
	}
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