<? 
include "../config/checkSession.php";
include "../config/conn.php";

if(isset($_POST['action']) && !empty($_POST['action'])) {
	
	$act = $_POST['action'];

	switch($act){
		case 'update_profiles':
			$user_id = $_POST['user_id'];
			$profile_id = $_POST['profile_id'];
			$fun = updateActiveProfile($profiles, $user_id, $profile_id);
		break;
		case 'delete_profile':
			$profile_id = $_POST['profile_id'];
			$user_id = $_POST['user_id'];
			$fun = deleteProfile($profiles, $profile_id, $user_id);
		break;
		case 'add_note':
		  	$tracker = new Tracker($conn); 
			$record_id = $_POST['record_id'];
			$note = $_POST['note'];
			$fun = addNote($tracker, $note, $record_id);
		break; 
	}
}

	function updateActiveProfile($profiles, $user_id, $profile_id){
		$feedback = $profiles->updateActiveProfile($user_id, $profile_id);
		if ( $feedback ){
			return true;
		}
	}

	function deleteProfile($profiles, $profile_id){
		$feedback = $profiles->deleteProfile($profile_id);
		if ( $feedback ){
			return true;
		}
	}

	function addNote($tracker, $note, $record_id){
		$feedback = $tracker->addNote($note, $record_id);
		if ( $feedback ){
			return true;
		}
	}

?>