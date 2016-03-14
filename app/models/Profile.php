<?php
	class Profile
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		// Return GPS Coordinates Location
		public function returnCoordinates($lat,$long){
			$url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false";
   			$curlData=file_get_contents(    $url);
    		$address = json_decode($curlData);
    		$a=$address->results[0];
    		return explode(",",$a->formatted_address);
		}

		public function returnExpChar($goal){
			switch($goal){
				case 0:
					return "No Experience";
					break;
				case 1:
					return "Less than 6 months";
					break;
				case 2:
					return "Between 6 and 12 months";
					break;
				case 3:
					return "Between 1 and 2 years";
					break;
				case 4:
					return "More than 2 years";
					break;
			}
		}

		public function returnGoalChar($goal){
			switch($goal){
				case 0:
					return "No Goal";
					break;
				case 1:
					return "Build Muscle";
					break;
				case 2:
					return "Loose Fat";
					break;
				case 3:
					return "Increase Strength";
					break;
				case 4:
					return "Improve Performance";
					break;
				case 5:
					return "General Health And Wellbeight";
					break;
			}
		}

		// Create a profile for the user with the form
		public function createProfile($data){
			// SQL Statement
			$sql = "INSERT into db_profile(id, name, surname, workout_exp, weight, height, location)
					VALUES(:id, :name, :surname, :workout_exp, :weight, :height, :location)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':id', $data[id], PDO::PARAM_STR);
			$stmt->bindParam(':name', $data[name], PDO::PARAM_STR);
			$stmt->bindParam(':surname', $data[surname], PDO::PARAM_STR);
			$stmt->bindParam(':workout_exp', $data[workout_exp], PDO::PARAM_STR);
			$stmt->bindParam(':weight', $data[weight], PDO::PARAM_STR);
			$stmt->bindParam(':height', $data[height], PDO::PARAM_STR);
			$stmt->bindParam(':location', $data[location], PDO::PARAM_STR);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		// Edit a user profile
		public function editProfile($data){
			// SQL Statement
			$sql = "UPDATE db_profile
					SET name = :name, surname = :surname, workout_exp = :workout_exp, weight = :weight, height = :height, location = :location
					WHERE id = :id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':id', $data[id], PDO::PARAM_STR);
			$stmt->bindParam(':name', $data[name], PDO::PARAM_STR);
			$stmt->bindParam(':surname', $data[surname], PDO::PARAM_STR);
			$stmt->bindParam(':workout_exp', $data[workout_exp], PDO::PARAM_STR);
			$stmt->bindParam(':weight', $data[weight], PDO::PARAM_STR);
			$stmt->bindParam(':height', $data[height], PDO::PARAM_STR);
			$stmt->bindParam(':location', $data[location], PDO::PARAM_STR);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		// Fetch ALL profiles
		public function fetchAllRows(){
			// SQL Statement
			$sql = "SELECT * FROM sc_profile";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			$stmt->execute();
			// Fetch Query
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Return results to nest variable
			return $result;
		}
		// Add a goal for a user
		public function addGoal($id, $goal){
			// SQL Statement
			$sql = "INSERT INTO db_goal(user_id, goal)
					VALUES(:user_id, :goal)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
			$stmt->bindParam(':goal', $goal, PDO::PARAM_STR);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		// Remove a goal for a user
		public function removeGoal($id, $goal){
			// SQL Statement
			$sql = "DELETE FROM db_goal WHERE id = $id AND goal = $goal";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}			
		}

		// Fetch All Goals
		public function fetchAllGoals($id){
			// SQL Statement
			$sql = "SELECT * FROM sc_goals WHERE user_id = $id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			$stmt->execute();
			// Fetch Query
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Return results to nest variable
			return $result;
		}		
	}
?>