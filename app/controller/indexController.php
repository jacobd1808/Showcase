<?php
	
	$User = new User($conn);
	$Profile = new Profile($conn);
	$Relation = new Relation($conn);

	$check_exist = $Profile->fetchProfile($_SESSION['ifitness_id']);

?>
