<?

	$frontPage = new Frontpage($conn);
	$register_date = date('Y-m-d');

  if (isset($_POST["register"])) { 
    
    // Store all Data in array to pass to Model
    $data = array(
      'username' => $_POST["u_username"], 
      'name' => $_POST["u_name"],
      'surname' => $_POST["u_surname"],
      'email' => $_POST["u_email"],
      'password' => md5($_POST["u_password"]),
      'gender' => $_POST["u_gender"],
      'register_date' => $register_date
    );

    // Validation 
    if (empty($_POST['u_username']) || 
        empty($data['name']) || 
        empty($data['email']) || 
        empty($_POST['u_password']) || 
        empty($data['gender']) 
      ) { 
        $feedback = array( "type" => 'error', "message" => 'You must fill in all the fields' ); 
      } else { 
        $register_user = $frontPage->registerUser($data);
      if (!$register_user) { 
        // If Something goes wrong 
        $feedback = array( "type" => 'error', "message" => 'Something went wrong' ); 
      } else { 
        $frontPage->loginUser($data);
        header("Location: index.php");
      }
    }
    
  } 
  // AIzaSyAtWI7CUtECvJEr5xHn-h7cT0JEQXc93zc thats my google maps API key 
?>