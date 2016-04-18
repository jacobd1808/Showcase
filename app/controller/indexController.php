<?php 

	$Profile = new Profile($conn);
	$Relation = new Relation($conn);

	// If user submits new feed post 
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

	// If user deletes new feed post 
	if (isset($_GET['post_id'])) { 
		$post_id = $_GET['post_id']; 
		$deletePost = $Relation->deleteStatus($post_id, $_SESSION['ifitness_id']);
		if ($deletePost) { 
	 		$feedback = array( "type" => 'valid', "message" => 'Post Deleted' );
		} else { 
			$feedback = array( "type" => 'error', "message" => 'Something went Wrong' );
		}
	}

	// Fetch all Feed posts 
	$profile_info = $Profile->fetchProfile($_SESSION['ifitness_id']);
	$feed = $Relation->fetchNewsFeed($_SESSION['ifitness_id']);

	// Fetch recconmendation list 
	if ( $profile_info['latitude'] != 0 && $profile_info['longitude'] != 0){
	    include "app/controller/recommendationsController.php";
	    $count = 0; 
	    $recArray = array(); 
	    $sameGymCount = count($sameGym);
	    $recCount = count($recommendations);

	    // Builds Recommendation Array
	    if ($sameGymCount < 3) { 

	      if ($sameGymCount != 0) {
	        echo 'samegym';
	        foreach ($sameGym as $gymRec) { 
	            $typeArray = array('type'=>'sameGym');
	            $gymRec = array_merge($gymRec, $typeArray);
	            array_push($recArray, $gymRec);
	            $count++; 
	        }
	      }
	      foreach($recommendations as $rec) { 
	        if(!in_array($rec, $recArray)) {
	          if(checkDistance($profile_info, $rec) <= 10000) {
	            if ($count < 3) { 
	              $typeArray = array('type'=>'samePreferences');
	              $rec = array_merge($rec, $typeArray);
	              array_push($recArray, $rec);
	              $count++; 
	            }
	          }
	        }
	      }
	    } else {
	      array_push($recArray, $rec);
	    }    
	  } else {
	    $recArray = 0;
	  }
?>