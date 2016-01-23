<?php 
	class Tracker
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		public function fetchAllSymptoms(){
			$query = "SELECT * FROM symptoms_list";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $getData;
		}

		public function fetchSymptoms($id){
			$query = "SELECT * FROM symptoms_list WHERE id = $id";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetch(PDO::FETCH_ASSOC);
			
		 return $getData;
		}

		public function fetchAllRecords($id){
			$query = "SELECT * FROM symptom_tracker 
					  INNER JOIN profiles
					  ON symptom_tracker.profile_id = profiles.profile_id
					  WHERE symptom_tracker.profile_id = $id
					  ORDER BY date DESC";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		 return $getData;
		}

		public function fetchRecord($id){
			$query = "SELECT * FROM symptom_tracker WHERE id = $id";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetch(PDO::FETCH_ASSOC);
			
		 return $getData;
		}

		// Creating new Entry
		
		public function createSymptomProfile($data, $id) { 	

			$sql = "INSERT INTO symptom_tracker (temperature, chills, fatique, cough, body_ache, diarrhea, ear_ache, headache, nausea, runny_nose, short_breath, sore_throat, stomache_ache, profile_id) 
					VALUES ('$data[temperature]', $data[chills], $data[fatique], $data[cough], $data[body_ache], $data[diarrhea], $data[ear_ache], $data[headache], $data[nausea], $data[runny_nose], $data[short_breath], $data[sore_throat], $data[stomache_ache], 
						$id)";
			$stmt = $this->conn->prepare($sql);  
			
			if ($stmt->execute()) { 
				return true;
			}  
		} 

		public function editSymptomProfile($data, $id, $record_id) { 	

			$sql = "UPDATE symptom_tracker
					SET     
							temperature='$data[temperature]',
							chills=$data[chills],
							fatique=$data[fatique],
							cough=$data[cough],
							body_ache=$data[body_ache],
							diarrhea=$data[diarrhea],
							ear_ache=$data[ear_ache],
							headache=$data[headache],
							nausea=$data[nausea],
							runny_nose=$data[runny_nose],
							short_breath=$data[short_breath],
							sore_throat=$data[sore_throat],
							stomache_ache=$data[stomache_ache]
					WHERE id = $record_id";

			$stmt = $this->conn->prepare($sql);  
			
			if ($stmt->execute()) { 
				return true;
			}  
		} 

		public function addNote($note, $record_id) { 	
			$sql = "UPDATE symptom_tracker
					SET note = '$note'
					WHERE id = $record_id";
			$stmt = $this->conn->prepare($sql);    
			$stmt->execute();

			if ($stmt->execute()) {
				return true;
			}			
		} 	

	} 
		
?> 