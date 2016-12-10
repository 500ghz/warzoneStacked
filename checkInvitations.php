<?php
$invitations = array();
$res = $conn->query($sql);
if($row = $res->fetch_assoc()){
	$invitations["invitationFrom"]=$row["invitingPlayer"];
	$invitations["invitationStatus"]='true';		
}else{
	$invitations["invitationFrom"]='none';
	$invitations["invitationStatus"]='false';
}
echo json_encode($invitations);
?>