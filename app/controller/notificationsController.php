<?php
  	include "../../../app/config/checkSession.php";
	include "../../../app/config/conn.php"; 

	$Relation = new Relation($conn);

	$notifications = $Relation->fetchNotifications($_SESSION['ifitness_id']);;
?>