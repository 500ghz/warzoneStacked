
<?php

		$connection = mysql_connect("localhost", "root", "");
		$db = mysql_select_db("warzone", $connection);

		
		
		
		
		mysql_close($connection);
	
}
?>