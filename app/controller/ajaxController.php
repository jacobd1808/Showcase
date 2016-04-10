<? 
	include "../config/checkSession.php";
	include "../config/conn.php";

	$Profile = new Profile($conn);
	$Relation = new Relation($conn);
	$User = new User($conn);

if(isset($_POST['action']) && !empty($_POST['action'])) {
	
	$act = $_POST['action'];

	switch($act){
		case 'create_profile':
			// Store all Data in array to pass to Model
		    $data = array(
		    	'id' => $_POST['id'],
				'workout_exp' => $_POST['workout_exp'],
				'goal' => $_POST['goal'],
				'latitude' => $_POST['latitude'],
				'longitude' => $_POST['longitude']
		    );

		    echo $data[id];
			return $Profile->setPreferences($data);
		break;
		case 'edit_profile':
			$data = array(
				'id' => $_POST['id'],
				'dob' => $_POST['dob'],
				'goal' => $_POST['goal'],
				'workout_exp' => $_POST['workout_exp'],
				'latitude' => $_POST['latitude'],
				'longitude' => $_POST['longitude'],
				'gym' => $_POST['gym'],
				'body_fat' => $_POST['body_fat'],
				'weight' => $_POST['weight'],
				'bio' => $_POST['bio'],
				'avatar' => basename($_POST['avatar'])
			);

			echo $Profile->editProfile($data);
		break;
		case 'check_postcode':
			$postal_code = $_POST['postal_code'];
			echo $coords = $Profile->returnPostalCode($postal_code);
		break;
		case 'return_address':
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];

			echo json_encode($Profile->returnCoordinates($latitude, $longitude));
		break;
		case 'fetch_profile':
			$user_id = $_POST['user_id'];
			$results = $Profile->fetchProfile($user_id);
			$results['location'] = $Profile->returnLocation($results['latitude'], $results['longitude']);
			$results['friends'] = $Relation->fetchFriendList($user_id);
			$results['relation'] = $Relation->checkRelation($_SESSION['ifitness_id'], $results['id']);
			echo json_encode($results);
		break;
		case 'friend_request':
			$user_1 = $_POST['user_1'];
			$user_2 = $_POST['user_2'];

			echo $Relation->requestFriend($user_1, $user_2);
		break;
		default: 
			return "bloop";
		break;
	}
}

?>