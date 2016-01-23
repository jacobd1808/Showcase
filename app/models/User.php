<?php 
	class User
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		/* 
			FOR FETCHING ALL ROWS IN A DATABASE 
		*/ 
		public function fetchAllProfiles($id){
			$query = "SELECT * FROM profiles WHERE user_id = $id";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $getData;
		}

		/* 
			FOR FETCHING SINGLE ROW FROM DATABASE 
		*/ 	
		public function fetchProfile($profile_id) {
			$query = "SELECT * FROM profiles WHERE profile_id = $profile_id";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetch(PDO::FETCH_ASSOC);
			
		 return $getData;
		}

		// FOR CREATING A NEW ROW 
		
		public function createProfile($data, $id) { 	

			$sql = "INSERT INTO profiles (profile_name, gender, dob, colour_theme, user_id) 
					VALUES (:name, :gender, :dob, :theme, $id)";
			$stmt = $this->conn->prepare($sql);  
			
			$stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);   
			$stmt->bindParam(':gender', $data['gender'], PDO::PARAM_INT);   
			$stmt->bindParam(':dob', $data['dob'], PDO::PARAM_STR);			
			$stmt->bindParam(':theme', $data['theme'], PDO::PARAM_STR);
			
			if ($stmt->execute()) { 
				$profile_id = $this->conn->lastInsertId();	
				$sql = "UPDATE users
					SET active_profile = $profile_id
					WHERE id = $id";
				$stmt = $this->conn->prepare($sql); 
				$stmt->execute();
				return true;
			}  
		} 

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

		public function deleteProfile($id, $user_id){
			$sql = "DELETE FROM profiles WHERE profile_id = :id";
			$stmt = $this->conn->prepare($sql);  
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if ( $stmt->execute()){
				$sql = "UPDATE users
					SET active_profile = NULL
					WHERE id = $user_id";
				$stmt = $this->conn->prepare($sql); 
				if ($stmt->execute()) { 
					return true;
				}
			}
		}
		
		/* 
			Log User In 
		*/ 
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

		public function fetchUser($username){
			$query = "SELECT * FROM users 
					  INNER JOIN profiles
					  ON users.active_profile = profiles.profile_id
					  WHERE users.user = '$username' ";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetch(PDO::FETCH_ASSOC);
			return $getData;
		}

		public function checkProfiles($username){
			$query = "SELECT * FROM users 
					  WHERE user = '$username' ";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetch(PDO::FETCH_ASSOC);
			return $getData;
		}

		public function createUser($data) { 	

			$sql = "INSERT INTO users (user, pass, email, name) 
					VALUES (:user, :pass, :email, :name)";
			$stmt = $this->conn->prepare($sql);  
			
			$stmt->bindParam(':user', $data['username'], PDO::PARAM_STR);     
			$stmt->bindParam(':pass', $data['password'], PDO::PARAM_STR);			
			$stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
			$stmt->bindParam(':name', $data['name'], PDO::PARAM_INT); 
			
			if ($stmt->execute()) { 
				return true;	
			}  
		} 

		public function updateActiveProfile($user_id, $profile_id) { 	
			$sql = "UPDATE users
					SET active_profile = $profile_id
					WHERE id = $user_id";
			$stmt = $this->conn->prepare($sql);    
			$stmt->execute();

			if ($stmt->execute()) {
				return true;
			}			
		} 	
	} 
		
?> 