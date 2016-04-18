<?php 

	$Profile = new Profile($conn);
	$Relation = new Relation($conn);


  if (isset($_GET['accept'])){
    $id = $_SESSION['ifitness_id'];
    $other_id = $_GET['accept'];
    $not_id = $_GET['id'];

    $your_profile = $Profile->fetchProfile($id);
    $his_profile = $Profile->fetchProfile($other_id);

    $Relation->acceptRequest($id, $other_id, $his_profile['name'], $his_profile['surname']);
    $Relation->acceptRequest($other_id, $id, $your_profile['name'], $your_profile['surname']);
    $remove = $Relation->removeNotification($not_id);

    if($remove) { 
      $feedback = array( "type" => 'valid', "message" => 'Request Accepted' );
    }

  } else if (isset($_GET['refuse'])){
    $id = $_GET['refuse'];
    $Relation->removeNotification($id);
  }

	$friends = $Relation->fetchFriendList($_SESSION['ifitness_id']);
?>