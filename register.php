<?php
  session_start();
  include_once "app/config/conn.php";
  include "app/controller/registerController.php";

  if(isset($_SESSION['username'])) { 
    header("Location: index.php");
  }

	$pageOpt = array(
		"title"			    =>	"Register", 
		'navName' 		  	=> 	"", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	"",
	);

?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php"; ?>
    </head>
    <body id='pre-login'>
      <div class='view'> 
        <form action='' method='post' name='register' id='register-form' class="pure-form pure-form-stacked modulated-box">
          <h1> Register </h1>
          <fieldset>
              <label for="u_name">First Name </label>
              <input type='text' name='u_name' id='u_name' />
              <!-- -->
              <label for="u_surname">Surname </label>
              <input type='text' name='u_surname' id='u_surname' />
              <!-- -->
              <label for="u_surname">Surname </label>
              <select name="u_gender" id="u_gender">
              	  <option value="">---</option>
                  <option value="1">Male</option>
                  <option value="2">Female</option>
                  <option value="3">Other</option>
              </select>
              <!-- -->
              <label for="u_username">Username </label>
              <input type='text' name='u_username' id='u_username' />
              <!-- -->
              <label for="u_password">Password </label>
              <input type='password' name='u_password' id='u_password' />
              <!-- -->
              <label for="u_email">Email </label>
              <input type='text' name='u_email' id='u_email' />
              <!-- -->
              <input type='submit' name='register' id='register' />
          </fieldset>
        </form>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>