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
				'goal' => $_POST['workout_exp'],
				'latitude' => $_POST['latitude'],
				'longitude' => $_POST['longitude']
		    );

		    echo $data['id'];
			return $Profile->createProfile($data);

		break;
	}
}

?>