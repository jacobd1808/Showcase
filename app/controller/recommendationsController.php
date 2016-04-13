<?php

	$User = new User($conn);
	$Profile = new Profile($conn);
	$Search = new Search($conn);


	// Fetch Users Profile 
	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);
	// Fetch All other Users 
	$address = $Profile->returnCoordinates($profile_info['latitude'], $profile_info['longitude']);

	// Fetch Based on Gym
	$sameGym = $Search->fetchSameGym($profile_info['id'], $profile_info['gym']);
	// Fetch Based on Goal & Location 
	$recommendations = $Search->fetchRecommendations($profile_info['id'], $profile_info['workout_exp'], $profile_info['goal']);

?> 