<?php
include('session.php');

if(isset($_POST['action']) && !empty($_POST['action'])) {
	//echo "working";
	$action = $_POST['action'];
	switch($action) {
		case 'test' : test();break;
		case 'blah' : blah();break;
        // ...etc...
	}
}

function test(){
	$connection = mysql_connect('localhost', 'root', ''); 

	mysql_select_db('warzone');

	$query = "SELECT * FROM login"; 
	$result = mysql_query($query);

	echo "<table>";
	echo "	<tr><th>Player Name</th>
			<th>Invite Status</th></tr>";

	while($row = mysql_fetch_array($result)){   
	//Creates a loop to loop through results
		echo "<tr><td>" . $row['username'] . "</td> <td><button>Invite player</button></td> </tr>" ; 
	}

echo "</table>"; //Close the table in HTML

}
?>