<?php
  session_start();
  include_once "app/config/conn.php";

  if(isset($_SESSION['username'])) { 
    header("Location: index.php");
  }

	$pageOpt = array(
		"title"			    =>	"Register", 
		'navName' 		  	=> 	"", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	"",
	);

  if (isset($_POST["register"])) { 
    // Store all Data in array to pass to Model
    $data = array(
      'username' => $_POST["username"], 
      'name' => $_POST["name"],
      'email' => $_POST["email"],
      'password' => md5($_POST["password"]),
      'gender' => $_POST["email"],
    );

    // Validation 
    if (!isset($data['username']) || !isset($data['name']) || !isset($data['email']) || !isset($data['password'])) { 
      $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>You must fill in all the fields</em>' ); 
    } else { 
      // If Validation passes, send data to controller
      $newUser = $profiles->createUser($data);
      if (!$newUser) { 
        // If Something goes wrong 
        $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>Something went wrong</em>' ); 
      } else { 
        // In Works (Need icon changing)
        $feedback = array( "type" => 'confirm', "message" => '<i class="material-icons">error</i><em>Successfully Registered, <a href="login.php"> Log in</a></em>' );  
      }
    }
    
  } 

?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php"; ?>
    </head>
    <body id='pre-login'>
      <div class='view'> 
        <!-- 
          Username, Email, Password, First Name, Surname, Gender 
          Validation for everything
        --> 
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>