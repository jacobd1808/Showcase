<?php

// Define Variables 

$goals = array(
    array("Build Muscle", '1'),
    array("Loose Fat", "2"),
    array("Increase Strength", "3"), 
    array("Improve Performance", "4"),
    array("General Health and Wellbeing", "5"),
);

$experience = array(
	array("Less than 6 month", '1'),
	array("6 - 12 month", "2"),
	array("1 - 2 years", "3"), 
	array("2 years or more", "4"),
);

function getDistance( $latitude1, $longitude1, $latitude2, $longitude2 ) {  
    $earth_radius = 6371;

    $dLat = deg2rad( $latitude2 - $latitude1 );  
    $dLon = deg2rad( $longitude2 - $longitude1 );  

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
    $c = 2 * asin(sqrt($a));  
    $d = $earth_radius * $c;  

    return $d;  
}

function avatarExists($avt, $popup) { 
    if ($avt != '') {
        return 'assets/img/avatars/cropped/'.$avt; 
    } else {
        return 'assets/img/avatars/cropped/no_avatar.gif';
    }
}
  
?> 