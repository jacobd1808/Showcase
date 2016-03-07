<?php 
	class User
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		// Fetch ALL information on the user
		public function fetchAllRows($id){
			// SQL Statement
			$sql = "SELECT * FROM sc_user WHERE id = $id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			$stmt->execute();
			// Fetch Query
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			// Return results to nest variable
			return $result;
		}

		// Fetch SPECIFIC information on the user
		public function fetchOneRow($id, $row){
			// SQL Statement
			$sql = "SELECT $row FROM sc_user WHERE id = $id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			$stmt->execute();
			//Fetch Query
			$result = $stmt->fetchColumn();
			// Return value
			return $result;
		}

		// Update profile information
		public function updateProfile( $data){
			// Write SQL Statement
			$sql = "UPDATE sc_user
					SET name = :name, surname = :surname, gender = :gender, email = :email 
					WHERE id = :id";

			// Prepare SQL Update
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':id', $data['id'], PDO::PARAM_STR);
			$stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
			$stmt->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
			$stmt->bindParam(':gender', $data['gender'], PDO::PARAM_STR);
			$stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);

			// Execute Update
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		/* I'M RESERVING THIS SECTION FOR DEV COMMUNICATION

			QUESTIONS NEED ANSWERING:
			Can two matching people favorite each other?	
				- Yeah, there will be an add freind feature
			Will the user have access to friendlist?		
				- Yeah
			Will users list their hobbies?					
				- There will be a full profile for each user, this will need a seperate database (or more)
			How will the whole "fitness" part of this app work? ( I DON'T WORK OUT I'M IGNORANT) 
				- Focus more on a social platform right now. Ill write a list of stuff that needs doing in order in another file 

			CONFIRM: (Y/N)
			If chats are saved and have their own dedicated page, it's a smart idea to make a Chat model.
				Y
			I will expand Friends and Chat log as their own database table.
				Y - Needs to have a date feild for when matched 
			Should register log you in right away after a few seconds of confirmation message showing.
				N - Redirect to login with confirmation message saying you may now log in
			Do users need to activate their account ? ( This is not common practice anymore)
				N - 
			Should Lost Password send you back your current password or re-assign you a new one and advice to remake a new password
				- Reassign a new one, no email confirmation (it's only a prototype)
			
		*/ 
	}		
?> 