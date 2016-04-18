<?php 
	class Frontpage
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		// Function to register the user.
		public function registerUser($data){
			// Write the SQL Insert Query
			$sql = "INSERT INTO sc_user (username, password, email, register_date)
					VALUES (:username, :password, :email, :register_date)";

			// Prepare the SQL Query
			$stmt = $this->conn->prepare($sql);

			// Assign the inserted values
			$stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
			$stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
			$stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
			$stmt->bindParam(':register_date', $data['register_date'], PDO::PARAM_STR);

			// Execute the query and IF it works
			if ($stmt->execute()){

				// Eventually include AUTO Login or something
				return $this->conn->lastInsertId();
			} else {

				// Shit went wrong dawg
				return false;
			}
		}

		public function checkUsername($username){
			// SQL Statement
			$sql = "SELECT * FROM sc_user WHERE username='$username'";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Execute SQL
			if ( $stmt->execute() ) {
				return count($stmt->fetchAll(PDO::FETCH_ASSOC));
			} else{
				return 0;
			}	
		}

		public function setOnline($id){
			$time = time();
			// SQL Statement
			$sql = "UPDATE sc_profile SET online=$time WHERE id=$id";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Execute SQL
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		public function loginUser($data){
			// SQL Statement
			$sql = "SELECT id FROM sc_user WHERE username = :username && password = :password";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(":username", $data['username'], PDO::PARAM_STR);
			$stmt->bindParam(":password", $data['password'], PDO::PARAM_STR);
			// Execute SQL
			$stmt->execute();
			$result = $stmt->fetchColumn();

			if ($result){
				// User has logged in
				$_SESSION['ifitness_id'] = $result;
				$this->setOnline($result);
				return true;
			} else {
				return false;
			}
		}



		// Function to create profile
		public function createProfile($data, $user_id){
			$time = time();
			// Write the SQL Insert Query
			$sql = "INSERT INTO sc_profile (id, name, surname, gender, register_date, online)
					VALUES (:id, :name, :surname, :gender, :register_date, :online)";

			// Prepare the SQL Query
			$stmt = $this->conn->prepare($sql);

			// Assign the inserted values
			$stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
			$stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
			$stmt->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
			$stmt->bindParam(':gender', $data['gender'], PDO::PARAM_STR);
			$stmt->bindParam(':register_date', $data['register_date'], PDO::PARAM_STR);
			$stmt->bindParam(':online', $time, PDO::PARAM_STR);

			// Execute the query and IF it works
			if ($stmt->execute()){
				return true;
			} else {
				return false;
			}
		}

		// Function to delete user
		public function deleteUser($id){
			// SQL Statement
			$sql = "DELETE FROM sc_user WHERE id = $id";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Execute SQL
			if ( $stmt->execute()){
				return true;
			} else {
				return false;
			}
		}
	}
?>