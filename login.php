<?php

  include_once "app/config/checkLogged.php";
  include_once "app/config/conn.php";
  include "app/controller/loginController.php";

  if(isset($_SESSION['username'])) { 
    header("Location: index.php");
  }

	$pageOpt = array(
		"title"			    =>	"Login", 
		'navName' 		  	=> 	"", 
		'cssIncludes'	  	=>	"", 
		"jsIncludes"	 	=>	"",
	);

?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php"; ?>
    </head>
    <body id='pre-login'>
      <div class='view'> 
          <h1> Login </h1>
          <fieldset>
            <form action='' method='post' name='login' id='login-form' class="pure-form pure-form-stacked modulated-box">
              <label for="u_username">Username </label>
              <input type='text' name='u_username' id='u_username' />
              <!-- -->
              <label for="u_password">Username </label>
              <input type='password' name='u_password' id='u_password' />
              <!-- -->
              <input type='submit' name='login' id='login' value='Login'/>
            </form>
          </fieldset>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>