<? 

	$Profile = new Profile($conn);
	$Relation = new Relation($conn);

	$friends = $Relation->fetchFriendList($_SESSION['ifitness_id']);
?>