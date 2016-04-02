<?php
	$Profile = new Profile($conn);
	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);

	$info = $Profile->returnDistance(45.424813, -73.63193690000003, 45.4419585, -73.67298819999996);
?>
