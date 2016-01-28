<?php
	
	$Relation = new Relation($conn);
	$User = new User($conn);

	$result = $Relation->acceptFriendRequest(13, $_SESSION['ifitness_id']);

	echo $result;
?>
