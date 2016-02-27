<?php
  session_start();
  //include_once "app/config/conn.php";
  //include "app/controller/registerController.php";

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
    <body class='image-background'>
      <div class='view'> 
        <div class='homepage-info vert-center'> 
            <img src='assets/img/logos/fitconnect-logo-text.png' alt='logo' class='full-logo'/>
            <br /> <big> Find, Connect, Train! </big> <br />
            <a href='' class='custom-btn small-button dark-color'> Find Out More </a>
        </div>
        <form action='' method='post' name='register' id='register-form' class="pure-form pure-form-stacked modulated-box vert-center">
          <h1> Register an account </h1>
          <fieldset>
            <div class="pure-g">
              <div class="pure-u-1 pure-u-md-1-2 l-cell">
                <label for="u_name">First Name <span></span></label>
                <input type='text' name='u_name' id='u_name'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 r-cell">
                <label for="u_surname">Surname <span></span></label>
                <input type='text' name='u_surname' id='u_surname'/>
              </div>
              <!-- -->
              <div class="pure-u-1 pure-u-md-1-1" style='display: none'>
              <label for="u_surname">Gender </label>
              <select name="u_gender" id="u_gender">
              	  <option value="">---</option>
                  <option value="1">Male</option>
                  <option value="2">Female</option>
                  <option value="3">Other</option>
              </select>
              </div>
              <!--
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_username">Username <span></span> </label>
                <input type='text' name='u_username' id='u_username' />
              </div>
              <!--
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_password">Password <span></span></label>
                <input type='password' name='u_password' id='u_password' />
              </div>
              <!-- -->
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_email">Email <span></span></label>
                <input type='text' name='u_email' id='u_email' />
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_email">Email <span></span></label>
                <input type='text' name='u_email' id='u_email' />
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_email">Email <span></span></label>
                <input type='text' name='u_email' id='u_email' />
              </div>
              <!-- -->
              <input type='submit' name='register' id='register' />
            </div>
          </fieldset>
        </form>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>