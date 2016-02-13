<?php 

  //include_once "app/config/checkSession.php";
  //include_once "app/config/conn.php";
  //include "app/controller/indexController.php";
	
	$pageOpt = array(
		"title"			    =>	"Welcome", 
		'navName' 		  	=> 	"home", 
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
        <header>
          <nav>
              <ul class='navigation-menu'>
                  <li><a href="#"><i class="material-icons">featured_play_list</i> Feed </a></li>
                  <li><a href='#'><i class="material-icons">search</i> Search </a> </li>
                  <li><a href="#"><i class="material-icons">sentiment_very_satisfied</i> Friends </a> </li>
                  <li><a href="#"><i class="material-icons">group</i>Groups</a></li>
                  <li><a href="#" class='de-emphasis'><i class="material-icons">play_for_work</i>Logout</a></li>
              </ul>
              <div class='user-profile-tab'> 
                <a href='#'> <i class="material-icons">account_circle</i> Jacob Dickinson </a>
              </div>
          </nav>
          <div class='clear'></div>
        </header>
        <div class='information-menu'>
        ABC
        </div>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>