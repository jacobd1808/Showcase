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

function returnDistance2($lat_1, $long_1, $lat_2, $long_2){
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$lat_1,$long_1&destinations=$lat_2,$long_2&mode=driving&key=AIzaSyBpnDemMPmCFjpy-AqKtlrSpQo7QNgqAKk";
    $curlData = file_get_contents($url);
    $address = json_decode($curlData);
    $a = $address->rows[0];
    $b = $a->elements[0];
    return $b->distance->value;
}

function displayLocation($location) { 
    if(count($location) != 5) { 
        return $location[1] . ", " . $location[2] . ", " . $location[3];
    } else { 
        return $location[2] . ", " . $location[3] . ", " . $location[4];
    }
}

function checkDistance($myPos, $recPos) { 
    $dist = returnDistance2( $myPos['latitude'], $myPos['longitude'], $recPos['latitude'], $recPos['longitude']);
    return $dist;
}


function avatarExists($avt, $popup) { 
    if ($avt != '') {
        return 'assets/img/avatars/cropped/'.$avt; 
    } else {
        return 'assets/img/avatars/cropped/no_avatar.gif';
    }
}
  
?> 