<?php
$connection = mysql_connect('localhost', 'root', ''); 

mysql_select_db('warzone');

$query = "SELECT * FROM login"; 
$result = mysql_query($query);

echo "<table>"; 

while($row = mysql_fetch_array($result)){   
//Creates a loop to loop through results
echo "<tr><td>" . $row['username'] . "</tr></td>" ; 
}

echo "</table>"; //Close the table in HTML
		
?>