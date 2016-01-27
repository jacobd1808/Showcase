<?

	$frontPage = new Frontpage($conn);
	$register_date = date('Y-m-d');

  // If REGISTER form submit button is pressed
  if (isset($_POST["register"])) { 
    // Store all Data in array to pass to Model
    $data = array(
      'username' => $_POST["u_username"], 
      'name' => $_POST["u_name"],
      'surname' => $_POST["u_surname"],
      'email' => $_POST["u_email"],
      'password' => md5($_POST["u_password"]),
      'gender' => $_POST["u_email"],
      'register_date' => $register_date
          );

    echo $register_date;

    /* Changed all of the !isset() to empty() because apparently PDO probably pre-declares all the variables and fills them with null. also empty($_POST['u_password']
       is an exception because MD5 probably makes the variable unreadable to empty(), so pre md5'ed var is used to test if variable is filled. */

    // Validation 
    if (empty($_POST['u_username']) || empty($data['name']) || empty($data['email']) || empty($_POST['u_password']) || empty($data['surname']) || empty($data['email']) || empty($data['gender']) ) { 
      $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>You must fill in all the fields</em>' ); 
    } else { 
      // If Validation passes, send data to model
      $register_user = $frontPage->registerUser($data);
      if (!$register_user) { 
      	echo $register_user;
        // If Something goes wrong 
        $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>Something went wrong</em>' ); 
      } else { 
        // In Works (Need icon changing)
        $feedback = array( "type" => 'confirm', "message" => '<i class="material-icons">error</i><em>Successfully Registered, <a href="login.php"> Log in</a></em>' );  
      }
    }
    
  } 

?>