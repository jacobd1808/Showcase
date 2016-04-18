<?php 
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
			case 'start_inbox':
				$data = array(
					'msg' => $_POST['msg'],
					'to_id' => $_POST['to_id'],
					'from_id' => $_POST['from_id'], 
				);
				if($Inbox->startInbox($data)) { 
					echo 1;
				} else { 
					echo 0;
				}
			break;
			case 'get_convo':
				$convo = $Inbox->getConvo($_POST['inbox_id']);
				foreach($convo as $x){
					$Inbox->setViewed($x['id']);
				}
				echo json_encode($convo);
			break;
			case 'send_message':
				$date = date('Y-m-d H:i:s');
				$data = array(
					'inbox_id' => $_POST['inbox_id'],
					'user_id' => $_POST['user_id'],
					'message' => $_POST['message'],
					'date_sent' => $date
				);
				echo json_encode($Inbox->sendMessage($data));
			break;
		}
	}

?>