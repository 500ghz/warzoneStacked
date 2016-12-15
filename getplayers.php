<?php
include('session.php');

if(isset($_POST['action']) && !empty($_POST['action'])) {
	$action = $_POST['action'];
	switch($action) {
		case 'get' : get();break;
		case 'username' : username($username = $_POST['username']);break;
	}
}

function get(){
	$connection = mysql_connect('localhost', 'root', ''); 

	mysql_select_db('warzone');
	$User = $_SESSION["login_user"];
	$query = "SELECT * FROM login WHERE username != '$User'"; 
	$result = mysql_query($query);

	echo "<table>";
	echo "	<tr><th>Player Name</th>
	<th>Invite Status</th></tr>";
	$i = 1;
	while($row = mysql_fetch_array($result)){   
	//Creates a loop to loop through results
		echo "<tr><td class 'username' id='$i'>" . $row['username'] . "</td> <td><button class='userID' id ='$i' data-param='button-$i'>Invite player</button></td> </tr>";
		$i++;
	}
echo "</table>"; //Close the table in HTML
}

function username($username){
	$User = $_SESSION["login_user"];
	$connection = mysql_connect('localhost', 'root', ''); 
	mysql_select_db('warzone');
	$query = "UPDATE lobby SET iUsername = '$User', pendingInvite = '1'  WHERE username = '$username'";
	$query2 = "UPDATE lobby SET invitedPlayer = '1'  WHERE username = '$User'";
	$result = mysql_query($query);
	$result2 = mysql_query($query2);

	echo $result;

}
?>