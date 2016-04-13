<?php
	class Search {

		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		public function fetchRecommendations($id, $exp, $goal){
			// SQL Statement
			$sql = "SELECT * FROM sc_profile WHERE workout_exp = $exp AND goal = $goal AND id != $id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

		public function fetchSameGym($id, $gym){
			// SQL Statement
			$sql = "SELECT * FROM sc_profile WHERE gym != 'No Gym' AND gym = '$gym' AND id != $id";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}

	}
?>