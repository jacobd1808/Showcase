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

		// Send a message to a conversation
		public function sendMessage($data){
			// SQL Statement
			$sql = "INSERT INTO sc_messages(inbox_id, message, date_sent)
					VALUES(:inbox_id, :message, :date_sent)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':inbox_id', $data['inbox_id'], PDO::PARAM_STR);
			$stmt->bindParam(':message', $data['message'], PDO::PARAM_STR);
			$stmt->bindParam(':date_sent', $data['message'], PDO::PARAM_STR);
			
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
			$sql = "SELECT * FROM sc_inbox WHERE first_user='$user_id' OR second_user='$user_id'";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			$stmt->execute();
			// Fetch Query
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Return results to nest variable
			$count = 0;
			
			foreach($results){
				$count++;
			}

			return $count;
		}
	}
?>