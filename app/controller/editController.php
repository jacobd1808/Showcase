<?php
	$Profile = new Profile($conn);
	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);
	$location = $Profile->returnCoordinates($profile_info['latitude'], $profile_info['longitude']);

	$dob = explode('-', $profile_info['dob']);

	if ($dob[0] == '0000') { 
		$dob[0] = '';
	} 
	if ($dob[1] == '00') { 
		$dob[1] = ''; 
	} 
	if ($dob[2] == '00') { 
		$dob[2] = '';
	}

	if($profile_info['weight'] == 0) { 
		$profile_info['weight'] = '';
	}

	if($profile_info['body_fat'] == 0) { 
		$profile_info['body_fat'] = '';
	}
?>