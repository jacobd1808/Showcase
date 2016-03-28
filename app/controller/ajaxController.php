<? 
	include "../config/checkSession.php";
	include "../config/conn.php";

	$Profile = new Profile($conn);
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
				'bio' => $_POST['bio']
			);

			echo $Profile->editProfile($data);
		break;
		case 'check_postcode':
			$postal_code = $_POST['postal_code'];
			$coords = $Profile->returnPostalCode($postal_code);
		break;
		case 'return_address':
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];

			echo json_encode($Profile->returnCoordinates($latitude, $longitude));
		break;
		default: 
			return "bloop";
		break;
	}
}

?>