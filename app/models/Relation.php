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
			$sql = "SELECT id FROM db_friend_req WHERE user_1 = :user_1 && user_2 = :user_2";
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
			$sql = "INSERT INTO db_friend_req (user_1, user_2) 
			        VALUES (:user_1, :user_2)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);

			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);

			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		// WHEN USER IS ACCEPTING FRIEND REQUEST
		public function acceptFriendRequest($id, $person_id){
			$rel_status = 1;
			// SQL Statement
			$sql = "INSERT INTO db_rel (user_1, user_2, rel_status) 
			        VALUES (:user_1, :user_2, :rel_status)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);
			$stmt->bindParam(':rel_status', $rel_status, PDO::PARAM_STR);			

			// Execute Query
			if ( $stmt->execute() ){
				if ( $this->deleteFriendRequest($person_id, $id) ){
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		// REMOVING FRIEND REQUEST
		public function deleteFriendRequest($id, $person_id){
			// SQL Statement
			$sql = "DELETE FROM db_friend_req WHERE user_1 = :user_1 && user_2 = :user_2";
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
			// SQL Statement
			$sql = "SELECT rel_status FROM db_rel WHERE user_1 = :user_1 && user_2 = :user_2";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);
			// Execute SQL 
			$stmt->execute();
			// Fetch Result

			if ( $stmt->fetchColumn() ){
				return $this->switchRelation( $stmt->fetchColumn() );
			} else {
				if ( $this->checkFriendRequest($id, $person_id) ){
					return "Friend Request Pending";
				} else {
					return "Unknown";
				}
			}

		}

		// Change Relation between 2 users ( ONLY FROM ONE QUERY, PLEASE CALL TWICE IF BLOCKING/UNFRIENDING )
		public function changeRelation($id, $person_id, $new_rel){
			// SQL Statement
			$sql = "UPDATE db_rel
					SET rel_status = :rel_status
					WHERE user_1 = :user_1 && user_2 = :user_2";

			// Prepare Query
			$stmt = $this->conn->prepare($sql);

			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);
			$stmt->bindParam(':rel_status', $new_rel, PDO::PARAM_STR);

			// Execute Query
			if ( $stmt->execute() ){
				return $new_rel;
			} else{
				return $person_id;
			}
		}

		public function blockPerson($id){
			// Fill
		}

		public function fetchFriendList($id){

		}

		public function fetchBlockList($id){

		}
	}