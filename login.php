<?php
  session_start();
  include_once "app/config/conn.php";

  if(isset($_SESSION['username'])) { 
    header("Location: index.php");
  }

	$pageOpt = array(
		"title"			    =>	"Login", 
		'navName' 		  	=> 	"login", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	"",
	);

  if (isset($_POST["login"])) { 
    $username = $_POST["username"]; 
    $password = md5($_POST["password"]);
    if ($username == '') { 
      $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>You must enter a username</em>' ); 
    } else if ($password == ''){ 
      $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>You must enter a password</em>' ); 
    } else { 
      $validUser = $profiles->validateUser($username, $password);
      if (!$validUser) { 
      $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>Username or password incorrect </em>' ); 
      } else { 
        header("Location: index.php"); 
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
            <input type='text' placeholder='Username' name='username'/>
            <input type='password' placeholder='Password' name='password' />
            <input type='submit' value='Log In' name='login' />
          </form>
          <a href='register.php' class='bold-link'> No Account? Register </a>
        </div>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>