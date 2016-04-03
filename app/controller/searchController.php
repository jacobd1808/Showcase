<?php
	
	$User = new User($conn);
	$Profile = new Profile($conn);


	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);
	$profiles = $Profile->fetchAllRows();
	$adress = $Profile->returnCoordinates($profile_info['latitude'], $profile_info['longitude']);
?>
