<?php
  session_start();

  if(isset($_SESSION['ifitness_id'])) { 
    header("Location: index.php");
  }

  include_once "app/config/conn.php";
  include "app/controller/registerController.php";

	$pageOpt = array(
		"title"			    =>	"Register", 
		'navName' 		  	=> 	"", 
		'cssIncludes'	  	=>	"", 
		"jsIncludes"	 	=>	"
      <script type='text/javascript' src='lib/jquery-validation/dist/jquery.validate.min.js' /></script>",
	);

?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php"; ?>
    </head>
      <div id='fixed-bg'> </div>
      <div id='main-content'>
      <div class='view' style='margin: 0'> 
        <div class='homepage-info vert-center'> 
            <img src='assets/img/logos/fitconnect-logo-text.png' alt='logo' class='full-logo'/>
            <br /> <big> Find, Connect, Train! </big> <br />
            <a href='login.php' class='custom-btn small-button dark-color model-popup' 
               data-content='about' data-title='About FitConnect'> Find Out More </a>
        </div>
        <form action='' method='post' name='register' id='register-form' class="pure-form pure-form-stacked modulated-box vert-center">
          <h1> Register an account </h1>
          <fieldset>
          <? if(isset($feedback)) { 
            echo "<div class='feedback-msg ".$feedback['type']."'>".$feedback['message']."</div>"; 
          } ?>
            <div class="pure-g">
              <div class="pure-u-1 pure-u-md-1-2 l-cell">
                <label for="u_name">First Name *<span></span></label>
                <input type='text' name='u_name' id='u_name' required/>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 r-cell">
                <label for="u_surname">Surname<span></span></label>
                <input type='text' name='u_surname' id='u_surname'/>
              </div>
              <!-- -->
              <div class="pure-u-1 pure-u-md-1-1" >
              <label for="u_surname">Gender *<span></span> </label>
              <input type='hidden' name='u_gender' id='u_gender' required/>
              <div class='c-align'>
                <div class='click-tile gender-tile tooltip left-tooltip' data-gender='1' style='margin-right: 20px' title="Male"> 
                  <i class="fa fa-male"></i>
                </div> 
                <div class='click-tile gender-tile tooltip right-tooltip' data-gender='2' title="Female"> 
                  <i class="fa fa-female"></i>
                </div>
              </div>
              </div>
              <!-- -->
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_username">Username *<span></span> </label>
                <input type='text' name='u_username' id='u_username' required />
              </div>
              <!-- -->
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_password">Password *<span></span></label>
                <input type='password' name='u_password' id='u_password' required />
              </div>
              <!-- -->
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_email">Email<span></span></label>
                <input type='text' name='u_email' id='u_email'/>
              </div>
              <!-- -->
              <input type='submit' name='register' id='register' />
            </div>
          </fieldset>
        </form>
      </div>
    </div>
    	<?php include_once "app/views/scripts.php"; ?>
      <script> 
      $( document ).ready(function() {
        
        $("#register-form").validate({
          ignore: "",
          errorPlacement: function () { },
          errorClass: "bob",
          highlight: function (element, errorClass, validClass) {
              $(element).parent().find('label').addClass("error");
          },
          unhighlight: function (element, errorClass, validClass) {
              $(element).parent().find('label').removeClass("error");
          }
        });

        $('.click-tile.gender-tile').click(function(){ 
          var genderVal = $(this).data('gender'); 
          $('#u_gender').val(genderVal);
          $('.gender-tile').removeClass('active');
          $(this).addClass('active');
        });

      });
      </script>
    </body>
</html>