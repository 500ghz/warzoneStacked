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
	})
});
});

//Refresh auto_load() function after 10000 milliseconds
setInterval(auto_load,10000);

function checkForInvitations(){

		// retrieve username from php session
		var invitedPlayer = '<?php echo $_SESSION["login_user"]; ?>'

		// send an ajax request
		$.ajax({	
			type: "Post",
			url: "checkInvitations.php",
			data:{ invitedPlayer: invitedPlayer }, // send username to check pending invitations for the player
			
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

								// forward user to the game 
								// TODO
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
			<b id = "welcome"> Welcome to the Warzone!!!! </b>
			<div id = "Userlogged_in">
			</div>
			<br/>
			<form action = "logout.php" method = "post">
				<button>Log Out</button>
			</form>
		</div>
		<section class="container">
			<div id = "player_list"></div>
		</section>
	</center>
</body>
</html>