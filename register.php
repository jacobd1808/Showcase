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

        <!-- Delete when ready
        <table style='border: 1px black solid;'> 
            <td colspan='2' >Tables are the shiz</td>
          </tr>
          <tr>
          <tr>
            <td>First Name</td>
            <td><input type='text' name='u_name' id='u_name' /></td>
          </tr>
          <tr>
            <td>Surname</td>
            <td><input type='text' name='u_surname' id='u_surname' /></td>
          </tr>
          <tr>
            <td>Gender</td>
            <td><select name="u_gender" id="u_gender">
                  <option value="1">Male</option>
                  <option value="2">Female</option>
                  <option value="3">Other</option>
               </select>
            </td>
          </tr>
          <tr>
            <td>Username</td>
            <td><input type='text' name='u_username' id='u_username' /></td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input type='pass' name='u_password' id='u_password' /></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><input type='text' name='u_email' id='u_email' /></td>
          </tr>
          <tr>
            <td colspan='2'><input type='submit' name='register' id='register' /></td>
          </tr>
        </table>
        -->
        <!-- 
          Username, Email, Password, First Name, Surname, Gender 
          Validation for everything
        --> 
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>