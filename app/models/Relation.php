<?php
	class Relation {

		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		public function switchRelation($x){
			switch($x){
				case 0:
					return false;
					break;
				case 1:
					return "Friends";
					break;
				case 2: 
					return "Blocked";
					break;
				default:
					return false;
					break;
			}
		}

		// CHECK IF FRIEND REQUEST EXISTS
		public function checkFriendRequest($id, $person_id){
			// SQL Statement
			$sql = "SELECT id FROM sc_friend_requests WHERE user_1 = :user_1 AND user_2 = :user_2";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);
			// Execute SQL 
			$stmt->execute();
			// Fetch Result

			if ( $stmt->fetchColumn() ){
				return true;
			} else {
				return false;
			}
		}

		// WHEN USER IS REQUESTING FRIEND
		public function requestFriend($id, $person_id){
			// SQL Statement
			$sql = "INSERT INTO sc_friend_requests (user_1, user_2) 
			        VALUES (:user_1, :user_2)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);

			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);

			// Execute Query
			if ( $stmt->execute() ){
				return "Hello";
			} else {
				return "Bye";
			}
		}

		// WHEN USER IS ACCEPTING FRIEND REQUEST
		public function acceptRequest($id, $person_id, $first_name, $last_name){
			$rel_status = 1;
			// SQL Statement
			$sql = "INSERT INTO sc_rel (user_id, friend_id, friend_name, friend_lastname) 
			        VALUES (:user_id, :friend_id, :friend_name, :friend_lastname)";;
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
			$stmt->bindParam(':friend_id', $person_id, PDO::PARAM_STR);
			$stmt->bindParam(':friend_name', $first_name, PDO::PARAM_STR);		
			$stmt->bindParam(':friend_lastname', $last_name, PDO::PARAM_STR);	

			// Execute Query
			if ( $stmt->execute() ){
				if ( $this->removeRequest($person_id, $id) ){
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		public function unfriendPerson($id, $person_id){
			// SQL Statement
			$sql = "DELETE FROM sc_rel WHERE user_id= :user_id && friend_id= :friend_id";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
			$stmt->bindParam(':friend_id', $person_id, PDO::PARAM_STR);
			// Execute SQL
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		// REMOVING FRIEND REQUEST
		public function removeRequest($id, $person_id){
			// SQL Statement
			$sql = "DELETE FROM sc_friend_requests WHERE user_1 = :user_1 && user_2 = :user_2";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);
			// Execute SQL
			 if ( $stmt->execute() ){
			 	return true;
			 } else{
			 	return false;
			 }
		}

		// Check Relation between 2 users
		public function checkRelation($id, $person_id){
			
			if ( $this->checkFriendRequest($id, $person_id) ){
				return "friend-request";
			} else if ( $this->checkFriendRequest($person_id, $id)){
				return "friend-add";
			} else if ( $this->checkFriends($id, $person_id)){
				return "friends";
			} else {
				return "add-friend";
			}
		}

		public function checkText($relation){
			switch($relation){
				case "friend-request":
					return "request pending";
					break;
				case "friend-add":
					return "accept request";
					break;
				case "friends":
					return "unfriend";
					break;
				case "add-friend":
					return "add friend";
					break;
			}
		}

		public function checkFriends($id, $person_id){

			// SQL Statement
			$sql = "SELECT * FROM sc_rel WHERE user_id= :user_id AND friend_id = :friend_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
			$stmt->bindParam(':friend_id', $person_id, PDO::PARAM_STR);
			// Execute SQL 
			$stmt->execute();
			// Fetch Result

			if ( $stmt->fetchColumn() ){
				return true;
			} else {
				return false;
			}
		}

		public function fetchFriendList($id){
			// SQL Statement
			$sql = "SELECT * FROM sc_rel WHERE user_id=$id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else{
				return "test";
			}
		}

		public function fetchNotifications($user_id){
			// SQL Statement
			$sql = " SELECT * FROM sc_notifications WHERE user_id= $user_id && viewed=0";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else{
				return "test";
			}
		}

		public function printNotification($data){
			if ( $data['type'] == 1){
				return "$data[person_name] $data[person_lastname] has sent you a friend request";
			} else {
				return "Error";
			}
		}

		public function createNotification($data){
			// SQL Statement
			$sql = "INSERT INTO sc_notifications(type, user_id, other_id, person_name, person_lastname)
					VALUES(:type, :user_id, :other_id, :person_name, :person_lastname)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':type', $data['type'], PDO::PARAM_STR);
			$stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_STR);
			$stmt->bindParam(':other_id', $data['other_id'], PDO::PARAM_STR);
			$stmt->bindParam(':person_name', $data['person_name'], PDO::PARAM_STR);
			$stmt->bindParam('person_lastname', $data['person_lastname'], PDO::PARAM_STR);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		public function deleteNotification($id){
			// SQL Statement
			$sql = "DELETE FROM sc_notifications WHERE id=$id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}
	}