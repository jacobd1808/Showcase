<?php 
	class User
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		$id = 1;

		// Fetch ALL information on the user
		public function fetchAllRows($id){
			// SQL Statement
			$query = "SELECT * FROM db_user WHERE id = $id";
			// Prepare Query
			$stmt = $this->conn->query($query);
			// Fetch Query
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Return results to nest variable
			return $result;
		}

		// Fetch SPECIFIC information on the user
		public function fetchOneRow($id, $row){
			// SQL Statement
			$query = "SELECT $row FROM db_user WHERE id = $id";
			// Prepare Query
			$stmt = $this->conn->query($query);
			//Fetch Query
			$result = $stmt->fetchColumn();
			// Return value
			return $result;
		}

		// Update profile information
		public function updateProfile($id, $data){
			// Write SQL Statement
			$sql = "UPDATE db_user
					SET name = :name, surname = :surname, gender = :gender, email = :email 
					WHERE id = $id";

			// Prepare SQL Update
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
			$stmt->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
			$stmt->bindParam(':gender', $data['gender'], PDO::PARAM_STR);
			$stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);

			// Execute Update
			if ($stmt->execute()){
				return true;
			} else {
				return false;
			}
		}

		// Fetch friend list ( IS FRIEND LIST AN IDEA? )
		public function fetchFriends($id){
			// Fill
		}

		// FETCH INFO FOR A CHAT
		public function fetchChatLog($id, $friend_id){
			// Fill
		}

		/* I'M RESERVING THIS SECTION FOR DEV COMMUNICATION

			QUESTIONS NEED ANSWERING:
			Can two matching people favorite each other?	
			Will the user have access to friendlist?
			Will users list their hobbies?
			How will the whole "fitness" part of this app work? ( I DON'T WORK OUT I'M IGNORANT)

			CONFIRM: (Y/N)
			If chats are saved and have their own dedicated page, it's a smart idea to make a Chat model.
			I will expand Friends and Chat log as their own database table.
			Should register log you in right away after a few seconds of confirmation message showing.
			Do users need to activate their account ? ( This is not common practice anymore)
			Should Lost Password send you back your current password or re-assign you a new one and advice to remake a new password

		// FOR EDITING A ROW 
		
		public function editProfile($data, $id) { 
			$sql = "UPDATE profiles
					SET profile_name = :name, gender = :gender, dob = :dob, colour_theme = :theme
					WHERE profile_id = $id";
			$stmt = $this->conn->prepare($sql);  
			$stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);   
			$stmt->bindParam(':gender', $data['gender'], PDO::PARAM_INT);   
			$stmt->bindParam(':dob', $data['dob'], PDO::PARAM_STR);			
			$stmt->bindParam(':theme', $data['theme'], PDO::PARAM_STR);  
			$stmt->execute();

			if ($stmt->execute()) {
				return true;
			}			
		}

		// FOR DELETING A ROW 

		public function deleteProfile($id){
			$sql = "DELETE FROM profiles WHERE profile_id = :id";
			$stmt = $this->conn->prepare($sql);  
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if ( $stmt->execute()){
				return true;
			}
		}
		
		/* 
			Log User In 
		
		public function validateUser($username, $password) {
			
			$stmt = $this->conn->prepare("SELECT * FROM users WHERE user = :username && pass = :password");
			$stmt->bindParam(":username", $username);
			$stmt->bindParam(":password", $password);
			$stmt->execute();
			
			if( $stmt->rowCount() > 0 ){
				$_SESSION['username'] = $username;
				return true;
        	}
		}
	} 
		
?> 