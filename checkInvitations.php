<?php
include('session.php');
$User = $_SESSION["login_user"];
$connection = mysql_connect('localhost', 'root', ''); 
mysql_select_db('warzone');
$sql = "SELECT iUsername FROM lobby WHERE usernamer = '$User'";
$invitations = array();
$res = $connection->query($sql);
if($row = $res->fetch_assoc()){
	$invitations["invitationFrom"]=$row["invitingPlayer"];
	$invitations["invitationStatus"]='true';		
}else{
	$invitations["invitationFrom"]='none';
	$invitations["invitationStatus"]='false';
}
echo json_encode($invitations);
?>