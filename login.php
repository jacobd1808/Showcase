<?php

  include_once "app/config/checkLogged.php";
  include_once "app/config/conn.php";
  include "app/controller/loginController.php";

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
    <body>
      <div id='fixed-bg'> </div>
      <div id='main-content'>
        <div class='view' style='margin-right: 0'> 
          <div class='homepage-info vert-center'> 
              <img src='assets/img/logos/fitconnect-logo-text.png' alt='logo' class='full-logo'/>
              <br /> <big> No Account? Register </big> <br />
              <a href='register.php' class='custom-btn small-button dark-color model-popup'> Register </a>
          </div>
          <form action='' method='post' name='login' id='register-form' class="pure-form pure-form-stacked modulated-box vert-center">
            <h1> Login </h1>
            <? if(isset($feedback)) { 
              echo "<div class='feedback-msg ".$feedback['type']."'>".$feedback['message']."</div>"; 
            } ?>
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
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>