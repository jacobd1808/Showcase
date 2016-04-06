<? 
	include "../config/checkSession.php";
	include "../config/conn.php";

	$Profile = new Profile($conn);
	$User = new User($conn);
	$Inbox = new Inbox($conn);


	if(isset($_POST['action']) && !empty($_POST['action'])) {

		$act = $_POST['action'];

		switch($act){	
			case 'get_inbox':
				echo json_encode($Inbox->getInbox($_POST['user_id']));
			break;
			case 'get_name':
				echo json_encode($Profile->fetchProfile($_POST['user_id']));
			break;
		}
	}

?>