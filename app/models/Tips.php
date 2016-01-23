<?php 
	class Tips
	{
		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		/* 
			FOR FETCHING ALL ROWS IN A DATABASE 
		*/ 
		public function fetchAllTips(){
			$query = "SELECT * FROM tips";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $getData;
		}

		public function fetchMonthsTip($tip){
			$query = "SELECT * FROM tips WHERE active = $tip";
			$stmt = $this->conn->query($query);
			$getData = $stmt->fetch(PDO::FETCH_ASSOC);
			return $getData;
		}
	} 
		
?> 