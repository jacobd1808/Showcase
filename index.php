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
         <!--<div class='default-popup' data-content='searchPreferences' data-title='Welcome to FitConnect .. Please set your search preferences'>  
         -->
      <?php }  ?>
      <div class='m-25'>
        <div class='feed modulated-box'> 
          <h2> FitConnect Feed </h2>
          <?php for($i = 0; $i < 17; $i++ ) { ?>
          <div class='feed-post'> 
            <div class='feed-post-title'>
              <img src='http://i.imgur.com/HQ3YU7n.gif' alt='avatar' class='user-avatar feed-avatar' />
              <span> Name </span>
            </div>
            <div class='feed-post'>
              Some text text text text 
            </div>
          </div>
          <? } ?>
        </div>
        <div class='feed-notices'> 
          <div class='modulated-box'>
            <h2> Recommendations</h2>
            Works 
          </div>
          <div class='modulated-box'>
            <h2> Freind Requests </h2>
            Works 
          </div>
        </div>
      </div>

    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>