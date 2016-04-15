<? 

	$Profile = new Profile($conn);
	$Relation = new Relation($conn);

	if (isset($_POST['submit-post'])){
		$data = array(
		'user_id' => $_SESSION['ifitness_id'],
		'message' => $_POST['feed-post'],
		'post_time' => time(),
		);

		$Relation->postStatus($data);

	}

	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);
	$feed = $Relation->fetchNewsFeed($_SESSION['ifitness_id']);

?>