<?php
	
	$User = new User($conn);
	$Profile = new Profile($conn);

	$profiles = $Profile->fetchAllRows();

	$adress = $Profile->returnCoordinates(45.480272799999995, -73.55874);
?>
