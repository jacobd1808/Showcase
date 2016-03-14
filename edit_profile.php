<?php 

  include_once "app/config/checkSession.php";
  include_once "app/config/conn.php";
  include "app/controller/indexController.php";
	
	$pageOpt = array(
		"title"			    =>	"FitConnect", 
		'navName' 		  	=> 	"edit_profile", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	" ",
	);


?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php";?>
    </head>
    <body>
      <?php include_once "app/views/header.php"; ?>
      <div class='default-popup' data-content='profile' data-title="Jacob's profile">  </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>