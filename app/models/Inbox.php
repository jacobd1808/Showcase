<?php 
	class Inbox
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		// Update last sender
		public function updateInbox($inbox, $user){
			// SQL Statement
			$sql = "UPDATE sc_inbox SET last_sender= :last_sender WHERE inbox_id= :inbox_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':last_sender', $user, PDO::PARAM_STR);
			$stmt->bindParam(':inbox_id', $inbox, PDO::PARAM_STR);

			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		// Start a conversation
		public function startInbox($data){
			// SQL Statement
			$sql = "INSERT INTO sc_inbox(title, first_user, second_user, last_sender)
					VALUES(:title, :first_user, :second_user, :last_sender)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
			$stmt->bindParam(':first_user', $data['first_user'], PDO::PARAM_STR);
			$stmt->bindParam(':second_user', $data['second_user'], PDO::PARAM_STR);
			$stmt->bindParam(':last_sender', $data['last_sender'], PDO::PARAM_STR);
			
			$data['id'] = $this->conn->lastInsertId();

			// Execute Query
			if ( $stmt->execute() ){
				$this->sendMessage($data);
				return true;
			} else {
				return false;
			}	
		}

		// Fetch all Inbox

		public function getInbox($user_id){
			// SQL Statement
			$sql = "SELECT sc_inbox.id, sc_inbox.title, sc_profile.name, sc_profile.surname FROM sc_inbox INNER JOIN sc_profile ON sc_inbox.second_user = sc_profile.id WHERE first_user='$user_id'";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			$stmt->execute();
			// Fetch Query
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Return results to nest variable
			if ( $result ){
				return $result;
			} else {
				return 0;
			}
		}

		public function getConvo($inbox_id){
			// SQL Statement
			$sql = "SELECT sc_messages.id, sc_messages.user_id, sc_messages.message, sc_messages.date_sent, sc_profile.name, sc_profile.surname, sc_profile.avatar_url 
			 		FROM sc_messages INNER JOIN sc_profile ON sc_messages.user_id = sc_profile.id WHERE sc_messages.inbox_id='$inbox_id'";
			// Prepare Query
			 $stmt = $this->conn->prepare($sql);
			 // Execute Query
			 $stmt->execute();
			 // Fetch Query
			 $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			 // Return results to nest variable
			 $count = 0;
			 if ( $result ){
			 	return $result;
			 } else {
			 	return 0;
			 }
		}

		public function getMessage($message_id){
			// SQL Statement
			$sql = "SELECT sc_messages.id, sc_messages.user_id, sc_messages.message, sc_messages.date_sent, sc_profile.name, sc_profile.surname, sc_profile.avatar_url
					 FROM sc_messages INNER JOIN sc_profile ON sc_messages.user_id = sc_profile.id WHERE sc_messages.id='$message_id'";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			$stmt->execute();
			// Fetch Query
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			// Return results to nest variable
			return $result;
		}

		public function sendMessage($data){
			// SQL Statement
			$sql = "INSERT INTO sc_messages(inbox_id, user_id, message, date_sent) VALUES (:inbox_id, :user_id, :message, :date_sent)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':inbox_id', $data['inbox_id'], PDO::PARAM_STR);
			$stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_STR);
			$stmt->bindParam(':message', $data['message'], PDO::PARAM_STR);
			$stmt->bindParam(':date_sent', $data['date_sent'], PDO::PARAM_STR);
			// Execute Query
			if ( $stmt->execute() ){
				return $this->getMessage($this->conn->lastInsertId());
			} else {
				return false;
			}
		}
	}
?>