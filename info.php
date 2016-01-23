<?php   
  include_once "app/config/checkSession.php";
  include_once "app/config/conn.php";

	$pageOpt = array(
		"title"			    =>	"Lets learn! ", 
		'navName' 		  	=> 	"info", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	" ",
	);

?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php"; ?>
    </head>
    <body>
      <?php include_once "app/views/header.php"; ?>
      <div class='sub-header theme-colour-darken tabbed'>
        <div class='tab theme-colour-main' data-tab='symptoms'> Symptoms</div>
        <div class='tab' data-tab='treatment'> Treatment </div>
        <div class='tab' data-tab='prevention'> Prevention </div>
        <div class='clear'> </div>
      </div>
      <div class='view'> 
        <ul class='tab-section' data-section='symptoms'>
          <li class='section-header'>Panda says that these are the symtoms to look out for when a cold is developing</li>
          <li> Scratchy or sore throat <span class='theme-colour-darken'></span></li>
          <li> Sneezing <span class='theme-colour-darken'></span></li>
          <li> Runny or Stuffy nose <span class='theme-colour-darken'></span></li>
          <li> Watery eyes <span class='theme-colour-darken'></span></li>
          <li> Coughing <span class='theme-colour-darken'></span></li>
        </ul>
        <ul class='tab-section' data-section='treatment'>
          <li class='section-header'>Panda says that these are some ways to treat a cold</li>
          <li> Drink plenty of water <span class='theme-colour-darken'></span></li>
          <li> Get plenty of rest <span class='theme-colour-darken'></span></li>
          <li> Eat plenty of fruit and veg <span class='theme-colour-darken'></span></li>
          <li> Suck on cough sweets to help with a sore throat <span class='theme-colour-darken'></span></li>
          <li> Liquid paracetamol such as Calpol <span class='theme-colour-darken'></span> </li>
        </ul>
        <ul class='tab-section' data-section='prevention'>
          <li class='section-header'>Panda says that these are some ways to defend your body from a cold</li>
          <li> Wash hands after going to the toilet <span class='theme-colour-darken'></span></li>
          <li> Don't go near people with a cold <span class='theme-colour-darken'></span></li>
          <li> Use tissues to sneeze and blow into <span class='theme-colour-darken'></span></li>
          <li> Wrap up warm in winter, colds are more likley to spread when it's colder <span class='theme-colour-darken'></span></li>
        </ul>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>