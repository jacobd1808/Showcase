<?php 

  include "app/config/checkSession.php";
  include "app/config/conn.php";
  include "app/controller/indexController.php";
	
	$pageOpt = array(
		"title"			    =>	"Welcome", 
		'navName' 		  	=> 	"feed", 
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
      <div class='view'> 
      <?php if ($profile_info['latitude'] == 0 && $profile_info['longitude'] == 0){ ?>
         <div class='default-popup' data-content='searchPreferences' data-title='Welcome to FitConnect .. Please set your search preferences'>  
      <?php }  ?>
          </div>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
      <script>
                // Click event function 

      </script>
    </body>
</html>