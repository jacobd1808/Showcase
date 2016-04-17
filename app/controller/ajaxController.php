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
			$coords = $Profile->returnPostalCode($postal_code);
			$coords = json_decode($coords);
			$coords->address = $Profile->returnCoordinates($coords->lat, $coords->lng);
			echo json_encode($coords);
		break;
		case 'return_address':
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];

			echo json_encode($Profile->returnCoordinates($latitude, $longitude));
		break;
		case 'update_slider':
			$user_id = $_POST['id'];
			$slider = $_POST['slider'];
			$Profile->updateSlider($user_id, $slider);
		break;
		case 'fetch_profile':
			$user_id = $_POST['user_id'];
			$results = $Profile->fetchProfile($user_id);
			$results['images'] = $Profile->fetchImages($results['name'], $results['surname'], $results['id']);
			$results['age'] = $Profile->fetchAge($results['dob']); 
			$results['location'] = $Profile->returnLocation($results['latitude'], $results['longitude']);
			$results['friends'] = $Relation->fetchFriendList($user_id);
			$results['relation'] = $Relation->checkRelation($_SESSION['ifitness_id'], $results['id']);
			$results['relation_t'] = $Relation->checkText($results['relation']);
			echo json_encode($results);
		break;
		case 'friend_request':
			$user_1 = $_POST['user_1'];
			$user_2 = $_POST['user_2'];

			$info = $Profile->fetchProfile($user_1);

			$data = array(
				'user_id' => $user_2,
				'other_id' => $user_1,
				'person_name' => $info['name'],
				'person_lastname' => $info['surname'],
				'type' => 1
			);

			echo $Relation->requestFriend($user_1, $user_2);
			echo $Relation->createNotification($data);
		break;
		case 'remove_request':
			$user_1 = $_POST['user_1'];
			$user_2 = $_POST['user_2'];

			echo $Relation->removeRequest($user_1, $user_2);
		break;
		case 'unfriend_person':
			$user_1 = $_POST['user_1'];
			$user_2 = $_POST['user_2'];

			echo $Relation->unfriendPerson($user_1, $user_2);
			echo $Relation->unfriendPerson($user_2, $user_1);
		break;
		case 'accept_request':

			$user_1 = $_POST['user_1'];
			$user_2 = $_POST['user_2'];
			$info_1 = $Profile->fetchProfile($user_1);
			$info_2 = $Profile->fetchProfile($user_2);

			echo $Relation->acceptRequest($user_1, $user_2, $info_2['name'], $info_2['surname']);
			echo $Relation->acceptRequest($user_2, $user_1, $info_1['name'], $info_1['surname']);
		break;
		case 'search_by_user':

			$term = $_POST['term'];

			$results = $Profile->fetchProfileByName($term);
			echo json_encode($results);
		break;
		case 'search_by_gym':

			$term = $_POST['term'];

			$results = $Profile->fetchProfileByGym($term);
			echo json_encode($results);
		break;
		case 'like_feed':
			$user_id = $_POST['user_id'];
			$feed_id = $_POST['feed_id'];
			$friend_id = $_POST['friend_id'];

			$info = $Profile->fetchProfile($user_id);

			$data = array(
				'user_id' => $friend_id,
				'other_id' => $user_id,
				'person_name' => $info['name'],
				'person_lastname' => $info['surname'],
				'type' => 2
			);				

			echo $Relation->likeFeed($user_id, $feed_id);
			echo $Relation->createNotification($data);
		break;
		case 'unlike_feed':
			$user_id = $_POST['user_id'];
			$feed_id = $_POST['feed_id'];		

			echo $Relation->unlikeFeed($user_id, $feed_id);
		break;
		case 'editAvatarLink': 
			$user_id = $_POST['user_id'];
			$avatar_url = basename($_POST['avatarURL']);		

			if($Profile->editAvatarLink($user_id, $avatar_url)) { 
				echo json_encode('updated'); 
			}	
		break;
		default: 
			return "bloop";
		break;
	}
}

?>