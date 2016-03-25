<?

	$frontPage = new Frontpage($conn);
	$register_date = date('Y-m-d');

  if (isset($_POST["register"])) { 
    
    // Store all Data in array to pass to Model
    $user_data = array(
      'username' => $_POST["u_username"], 
      'email' => $_POST["u_email"],
      'password' => md5($_POST["u_password"]),
      'register_date' => $register_date
    );

    $profile_data = array(
      'name' => $_POST["u_name"],
      'surname' => $_POST["u_surname"],
      'gender' => $_POST["u_gender"],
      'register_date' => $register_date
    );

    // Validation 
    if (empty($_POST['u_username']) || 
        empty($profile_data['name']) || 
        empty($user_data['email']) || 
        empty($_POST['u_password']) || 
        empty($profile_data['gender']) 
      ) { 
        $feedback = array( "type" => 'error', "message" => 'You must fill in all the fields' ); 
      } else { 
        $register_user = $frontPage->registerUser($user_data);
      if (!$register_user) { 
        // If Something goes wrong 
        $feedback = array( "type" => 'error', "message" => 'Something went wrong' ); 
      } else { 
        $create_profile = $frontPage->createProfile($profile_data, $register_user);
        if (!$create_profile ){
          $feedback = array( "type" => 'error', "message" => 'Something went wrong' ); 
        } else {
          $_SESSION['ifitness_id'] = $register_user;
          header("Location: index.php");
        }
      }
    }
  } 
  // AIzaSyAtWI7CUtECvJEr5xHn-h7cT0JEQXc93zc thats my google maps API key 
?>