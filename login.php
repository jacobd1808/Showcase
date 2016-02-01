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
    <body id='particle-background'>
      <div class='view'> 
        <form action='' method='post' name='login' id='login-form' class="pure-form pure-form-stacked modulated-box">
          <h1> Login </h1>
          <fieldset>
            <div class="pure-g">
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_username">Username <span></span></label>
                <input type='text' name='u_username' id='u_username'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_password">Password <span></span></label>
                <input type='password' name='u_password' id='u_password'/>
              </div>
              <input type='submit' name='login' id='login' value='Login'/>
            </div>
          </fieldset>
        </form>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>