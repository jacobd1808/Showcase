<?php
	class Profile
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		public function returnGoalChar($goal){
			switch($goal){
				case 0:
					return "No Goal";
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

	}
?>