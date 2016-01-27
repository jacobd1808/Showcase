<?php 
	class Frontpage
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		public function registerUser($data){
			// Write the SQL Insert Query
			$sql = "INSERT INTO db_user (username, name, surname, password, email, gender, register_date)
					VALUES (:username, :name, :surname, :password, :email, :gender, :register_date)";

			// Prepare the SQL Query
			$stmt = $this->conn->prepare($sql);

			// Assign the inserted values
			$stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
			$stmt->bindParam(':name', $data['username'], PDO::PARAM_STR);
			$stmt->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
			$stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
			$stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
			$stmt->bindParam(':gender', $data['gender'], PDO::PARAM_STR);
			$stmt->bindParam(':register_date', $data['register_date'], PDO::PARAM_STR);

			// Execute the query and IF it works
			if ($stmt->execute()){

				// Eventually include AUTO Login or something
				return true;
			} else {

				// Shit went wrong dawg
				return false;
			}
		}
	}
?>