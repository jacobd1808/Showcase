<?php
	$Profile = new Profile($conn);
	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);
	$location = $Profile->returnCoordinates($profile_info['latitude'], $profile_info['longitude']);

	$dob = explode('-', $profile_info['dob']);
?>