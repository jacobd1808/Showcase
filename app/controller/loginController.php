<?
	$frontPage = new Frontpage($conn);
	$loginStamp = Date('Y-m-d');

	// If LOGIN form button is pressed
 	if (isset($_POST["login"])) { 
    	
    	// Store all Data in array to pass to Model
    	$data = array(
    		'username' => $_POST["u_username"], 
    		'password' => md5($_POST["u_password"]),
    		'loginDate' => $loginStamp
    	);


    	// Validation
    	if (empty($data['username'])) {
    		// No username entered
      		$feedback = array( "type" => 'error', "message" => '<em>You must enter a username</em>' ); 
      		echo "no user";
    	} else if (empty($_POST['u_password'])){
    		// No password entered
      		$feedback = array( "type" => 'error', "message" => '<em>You must enter a password</em>' ); 
    	} else { 
      		$loginCheck = $frontPage->loginUser($data);

      		if (!$loginCheck) { 
      			// Invalid Username/Password
      			$feedback = array( "type" => 'error', "message" => '<em>Username or password incorrect </em>' ); 
      		} else { 
        	header("Location: index.php"); 
      		}
    	}
	} 

?>