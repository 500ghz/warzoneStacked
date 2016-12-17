<?php
include('session.php');

if(isset($_POST['action']) && !empty($_POST['action'])) {
	$action = $_POST['action'];
	switch($action) {
		case 'get' : get();break;
		case 'username' : username($username = $_POST['username']);break;
		case 'invites' : invites();break;
		case 'cancel' : cancel();break;
		case 'response' : response($data = $_POST['username']);break;
	}
}

function get(){
	$connection = mysql_connect('localhost', 'root', '');

	mysql_select_db('warzone');
	$User = $_SESSION["login_user"];
	$query = "SELECT * FROM lobby WHERE username != '$User'";
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
	$query = "UPDATE lobby SET iUsername = '$User'  WHERE username = '$username'";
	$query2 = "UPDATE lobby SET invitedPlayer = '1'  WHERE username = '$User'";
	$result = mysql_query($query);
	$result2 = mysql_query($query2);

	echo $result;

}
function invites(){
	$connection = mysql_connect('localhost', 'root', '');
	mysql_select_db('warzone');
	$User = $_SESSION["login_user"];
	$query = "SELECT iUsername FROM lobby WHERE username = '$User'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	echo $row[0];
	//$res->fetch_assoc()
}
function response($data){
	$connection = mysql_connect('localhost', 'root', ''); 
	mysql_select_db('warzone');
	$User = $_SESSION["login_user"];
	$query = "UPDATE lobby SET iUsername = '' WHERE username = '$iUsername'";
	$result = mysql_query($query);
	$row = mysql_fetch_row($result);
	echo $row[0];
	//$res->fetch_assoc()
}
function cancel(){
	$connection = mysql_connect('localhost', 'root', '');
	mysql_select_db('warzone');
	$User = $_SESSION["login_user"];
	$query = "UPDATE lobby SET iUsername = '' WHERE username = '$User'";
	//$query2 = "UPDATE lobby SET iUsername = username WHERE '$User' = username"; 
	//$resultFirst = mysql_query($query2);
	$result = mysql_query($query);
	//$row = mysql_fetch_row($result);
	//echo $row[0];
}

?>