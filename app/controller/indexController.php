<?php
	$Profile = new Profile($conn);
	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);
?>
