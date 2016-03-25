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
		public function updateEmailInfo( $data){
			// Write SQL Statement
			$sql = "UPDATE sc_user
					 email = :email 
					WHERE id = :id";

			// Prepare SQL Update
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);

			// Execute Update
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}
	}		
?> 