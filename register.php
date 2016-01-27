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
        <form action='' method='post' name='register'> 
        <table style='border: 1px black solid;'> 
          <tr>
            <td colspan='2' >Tables are the shiz</td>
          </tr>
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
                  <!-- It's better to have Other aswell. I don't know why but all the websites do it lol -->
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
        <!-- 
          Username, Email, Password, First Name, Surname, Gender 
          Validation for everything
        --> 
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>