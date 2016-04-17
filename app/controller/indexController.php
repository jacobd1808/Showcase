<? 

	$Profile = new Profile($conn);
	$Relation = new Relation($conn);

	if (isset($_POST['submit-post'])){
		$data = array(
			'user_id' => $_SESSION['ifitness_id'],
			'message' => $_POST['feed-post'],
			'post_time' => time(),
		);

		if ($data['message'] == '') { 
			$feedback = array( "type" => 'error', "message" => 'You must enter a post' );
		} else { 
			$newPost = $Relation->postStatus($data);
			if ($newPost) { 
	 			$feedback = array( "type" => 'valid', "message" => 'Successfuly Posted' );
			} else { 
				$feedback = array( "type" => 'error', "message" => 'Something went Wrong ' );
			}
		} 
	}

	if (isset($_GET['post_id'])) { 
		$post_id = $_GET['post_id']; 
		$deletePost = $Relation->deleteStatus($post_id, $_SESSION['ifitness_id']);
		if ($deletePost) { 
	 		$feedback = array( "type" => 'valid', "message" => 'Post Deleted' );
		} else { 
			$feedback = array( "type" => 'error', "message" => 'Something went Wrong' );
		}
	}

	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);
	$feed = $Relation->fetchNewsFeed($_SESSION['ifitness_id']);

?>