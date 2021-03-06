<?php
	class Relation {

		public function __construct($conn)
		{
			$this->conn = $conn;
		}

		public function switchRelation($x){
			switch($x){
				case 0:
					return false;
					break;
				case 1:
					return "Friends";
					break;
				case 2: 
					return "Blocked";
					break;
				default:
					return false;
					break;
			}
		}

		// CHECK IF FRIEND REQUEST EXISTS
		public function checkFriendRequest($id, $person_id){
			// SQL Statement
			$sql = "SELECT id FROM sc_friend_requests WHERE user_1 = :user_1 AND user_2 = :user_2";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);
			// Execute SQL 
			$stmt->execute();
			// Fetch Result

			if ( $stmt->fetchColumn() ){
				return true;
			} else {
				return false;
			}
		}

		// WHEN USER IS REQUESTING FRIEND
		public function requestFriend($id, $person_id){
			// SQL Statement
			$sql = "INSERT INTO sc_friend_requests (user_1, user_2) 
			        VALUES (:user_1, :user_2)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);

			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);

			// Execute Query
			if ( $stmt->execute() ){
				return "Hello";
			} else {
				return "Bye";
			}
		}

		// WHEN USER IS ACCEPTING FRIEND REQUEST
		public function acceptRequest($id, $person_id, $first_name, $last_name){

			$check = $this->checkFriends($id, $person_id);

			if ( $check != true){
				$rel_status = 1;
				// SQL Statement
				$sql = "INSERT INTO sc_rel (user_id, friend_id, friend_name, friend_lastname) 
				        VALUES (:user_id, :friend_id, :friend_name, :friend_lastname)";;
				// Prepare Query
				$stmt = $this->conn->prepare($sql);
				// Bind Parameters
				$stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
				$stmt->bindParam(':friend_id', $person_id, PDO::PARAM_STR);
				$stmt->bindParam(':friend_name', $first_name, PDO::PARAM_STR);		
				$stmt->bindParam(':friend_lastname', $last_name, PDO::PARAM_STR);	

				// Execute Query
				if ( $stmt->execute() ){
					if ( $this->removeRequest($person_id, $id) ){
						return true;
					} else {
						return false;
					}
				} else {
					return false;
				}
			} else {
				if ( $this->removeRequest($person_id, $id) ){
					return true;
				} else {
					return false;
				}
			}
		}

		public function unfriendPerson($id, $person_id){
			// SQL Statement
			$sql = "DELETE FROM sc_rel WHERE user_id= :user_id && friend_id= :friend_id";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
			$stmt->bindParam(':friend_id', $person_id, PDO::PARAM_STR);
			// Execute SQL
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		// REMOVING FRIEND REQUEST
		public function removeRequest($id, $person_id){
			// SQL Statement
			$sql = "DELETE FROM sc_friend_requests WHERE user_1 = :user_1 && user_2 = :user_2";
			// Prepare SQL
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_1', $id, PDO::PARAM_STR);
			$stmt->bindParam(':user_2', $person_id, PDO::PARAM_STR);
			// Execute SQL
			 if ( $stmt->execute() ){
			 	return true;
			 } else{
			 	return false;
			 }
		}

		// Check Relation between 2 users
		public function checkRelation($id, $person_id){
			
			if ( $this->checkFriendRequest($id, $person_id) ){
				return "friend-request";
			} else if ( $this->checkFriendRequest($person_id, $id)){
				return "friend-add";
			} else if ( $this->checkFriends($id, $person_id)){
				return "friends";
			} else {
				return "add-friend";
			}
		}

		public function checkText($relation){
			switch($relation){
				case "friend-request":
					return "request pending";
					break;
				case "friend-add":
					return "accept request";
					break;
				case "friends":
					return "unfriend";
					break;
				case "add-friend":
					return "add friend";
					break;
			}
		}

		public function checkNotifications($user_id){
			// SQL Statement
			$sql = "SELECT * FROM sc_notifications WHERE user_id=$user_id && viewed=0";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return count($stmt->fetchAll(PDO::FETCH_ASSOC));
			} else{
				return 0;
			}	
		}

		public function setViewed($not_id){
			// SQL Statement
			$sql = "UPDATE sc_notifications SET viewed=1 WHERE id=$not_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return true;
			} else{
				return false;
			}
		}

		public function checkFriends($id, $person_id){

			// SQL Statement
			$sql = "SELECT * FROM sc_rel WHERE user_id= :user_id AND friend_id = :friend_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':user_id', $id, PDO::PARAM_STR);
			$stmt->bindParam(':friend_id', $person_id, PDO::PARAM_STR);
			// Execute SQL 
			$stmt->execute();
			// Fetch Result

			if ( $stmt->fetchColumn() ){
				return true;
			} else {
				return false;
			}
		}

		public function fetchFriendList($id){
			// SQL Statement
			$sql = "SELECT * FROM sc_rel 
					INNER JOIN sc_profile 
						ON sc_rel.friend_id = sc_profile.id 
					WHERE sc_rel.user_id = $id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else{
				return "test";
			}
		}

		public function fetchNotifications($user_id){
			// SQL Statement
			$sql = " SELECT * FROM sc_notifications WHERE user_id= $user_id ORDER BY id DESC";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else{
				return "test";
			}
		}

		public function removeNotification($not_id){
			// SQL Statement
			$sql = "DELETE FROM sc_notifications WHERE id=$not_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		public function printNotification($data){

			if ( $data['type'] == 1){
				return "<span class='model-popup' data-content='profile' data-title='".$data['person_name']." ".$data['person_lastname']."&#39;s profile' data-profile-id='".$data['other_id']."'>".$data['person_name']." ".$data['person_lastname']."</span> has sent you a friend request 
					<a href='friends.php?accept=$data[other_id]&id=$data[id]' class='notification-action accept glow-hover'>accept</a>
					<a href='friends.php?refuse=$data[id]' class='notification-action deny glow-hover'>refuse</a>";
			} else if ( $data['type'] == 2) {
				return "<span class='model-popup' data-content='profile' data-title='".$data['person_name']." ".$data['person_lastname']."&#39;s profile' data-profile-id='".$data['other_id']."'>".$data['person_name']." ".$data['person_lastname']."</span> has liked your status";
			} else {
				return false;
			}
		}

		public function createNotification($data){
			$time = time();
			// SQL Statement
			$sql = "INSERT INTO sc_notifications(type, user_id, other_id, person_name, person_lastname, date_added)
					VALUES(:type, :user_id, :other_id, :person_name, :person_lastname, :date_added)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam(':type', $data['type'], PDO::PARAM_STR);
			$stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_STR);
			$stmt->bindParam(':other_id', $data['other_id'], PDO::PARAM_STR);
			$stmt->bindParam(':person_name', $data['person_name'], PDO::PARAM_STR);
			$stmt->bindParam('person_lastname', $data['person_lastname'], PDO::PARAM_STR);
			$stmt->bindParam('date_added', $time, PDO::PARAM_STR);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		public function deleteNotification($id){
			// SQL Statement
			$sql = "DELETE FROM sc_notifications WHERE id=$id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}


		public function postStatus($data){
			// SQL Statement
			$sql = "INSERT INTO sc_feed(user_id, message, post_time)
					VALUES(:user_id, :message, :post_time)";
			$stmt = $this->conn->prepare($sql);
			// Bind Parameters
			$stmt->bindParam('user_id', $data['user_id'], PDO::PARAM_STR);
			$stmt->bindParam('message', $data['message'], PDO::PARAM_STR);
			$stmt->bindParam('post_time', $data['post_time'], PDO::PARAM_STR);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		public function deleteStatus($post_id, $user_id){
			// SQL Statement
			$sql = "DELETE FROM sc_feed WHERE id = $post_id AND user_id = $user_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		public function fetchNewsFeed($id){
			// SQL
			$sql = "SELECT sc_feed.id, sc_feed.message, sc_feed.post_time, sc_feed.user_id, sc_rel.friend_id, sc_rel.friend_name, sc_rel.friend_lastname, sc_profile.avatar_url
					FROM sc_feed 
					INNER JOIN sc_rel 
						ON sc_feed.user_id = sc_rel.friend_id 
					INNER JOIN sc_profile 
						ON sc_feed.user_id = sc_profile.id 
					WHERE sc_rel.user_id=$id OR sc_feed.user_id = $id 
					GROUP BY sc_feed.id 
					ORDER BY sc_feed.post_time DESC";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else{
				return false;
			}			
		}

		public function fetchMyFeed($id){ 
			$sql = "SELECT * FROM sc_feed
					INNER JOIN sc_profile 
						ON sc_feed.user_id = sc_profile.id 
					WHERE sc_feed.user_id = $id 
					ORDER BY sc_feed.post_time DESC";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return $stmt->fetchAll(PDO::FETCH_ASSOC);
			} else{
				return false;
			}	
		}

		public function likeFeed($user_id, $feed_id){
			// SQL
			$sql = "INSERT INTO sc_likes(feed_id, user_id)
					VALUES(:feed_id, :user_id)";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Bind parameters
			$stmt->bindParam('feed_id', $feed_id, PDO::PARAM_STR);
			$stmt->bindParam('user_id', $user_id, PDO::PARAM_STR);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		public function unlikeFeed($user_id, $feed_id){
			// SQL
			$sql = "DELETE FROM sc_likes WHERE feed_id=$feed_id AND user_id=$user_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ){
				return true;
			} else {
				return false;
			}
		}

		public function fetchLikes($feed_id){
			// SQL 
			$sql = "SELECT * FROM sc_likes WHERE feed_id=$feed_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return count($stmt->fetchAll(PDO::FETCH_ASSOC));
			} else{
				return "test";
			}	
		}

		public function checkLike($feed_id, $user_id){
			// SQL
			$sql = "SELECT * FROM sc_likes WHERE feed_id=$feed_id AND user_id=$user_id";
			// Prepare Query
			$stmt = $this->conn->prepare($sql);
			// Execute Query
			if ( $stmt->execute() ) {
				return count($stmt->fetchAll(PDO::FETCH_ASSOC));
			} else{
				return "test";
			}		
		}

		public function ago($time)
		{
		   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
		   $lengths = array("60","60","24","7","4.35","12","10");

		   $now = time();

		       $difference     = $now - $time;
		       $tense         = "ago";

		   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		       $difference /= $lengths[$j];
		   }

		   $difference = round($difference);

		   if($difference != 1) {
		       $periods[$j].= "s";
		   }

		   return "$difference $periods[$j] ago ";
		}
	}
?>