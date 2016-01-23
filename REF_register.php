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
    $data = array(
      'username' => $_POST["username"], 
      'name' => $_POST["name"],
      'email' => $_POST["email"],
      'password' => md5($_POST["password"]),
    );

    if (!isset($data['username']) || !isset($data['name']) || !isset($data['email']) || !isset($data['password'])) { 
      $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>You must fill in all the fields</em>' ); 
    } else { 
      $newUser = $profiles->createUser($data);
      if (!$newUser) { 
      $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>Something went wrong</em>' ); 
      } else { 
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
     <div class='view' style='margin-bottom: 0'> 
        <div id='login-form'> 
          <img src='assets/img/logo.png' alt='Logo' id='logo'/>
          <?php if (isset($feedback)) { ?> 
          <div class='center-align'> 
            <span class='feedback-msg <?php echo $feedback["type"] ?>'> <?php echo $feedback['message'] ?></span>
          </div>
          <?php } ?>
          <form action='' method='post' class='custom-form pure-form'> 
            <input type='text' placeholder='Username' name='username' />
            <input type='text' placeholder='Name' name='name' />
            <input type='text' placeholder='Email' name='email' />
            <input type='password' placeholder='Password' name='password' />
            <input type='submit' value='Register' name='register' />
          </form>
          <a href='login.php' class='bold-link'> Go to Login </a>
        </div>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>