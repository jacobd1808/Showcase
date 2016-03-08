<?php
	
	$User = new User($conn);
	$Profile = new Profile($conn);

	$profiles = $Profile->fetchAllRows();

?>
