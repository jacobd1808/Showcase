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
      <div id='fixed-bg'> </div>
      <div id='main-content'>
      <?php include_once "app/views/header.php"; ?>
      <div class='view'> 
      <?php if ($profile_info['latitude'] == 0 && $profile_info['longitude'] == 0){ ?>
         <div class='default-popup' data-content='searchPreferences' data-title='Welcome to FitConnect .. Please set your search preferences'>  
      <?php }  ?>
      <div class='m-25'>
        <div class='feed'> 
          <div class='feed-add'> 
            <img src='http://i.imgur.com/HQ3YU7n.gif' alt='avatar' class='user-avatar feed-avatar' />
            <div> 
              <textarea name='feed-post' id='feed-post' placeholder='Make a post'></textarea>
              <button class='custom-btn'> Post </button>
            </div>
            <div class='clear'> </div>
          </div>
          <!-- --> 
          <?php for($i = 0; $i < 17; $i++ ) { ?>
          <div class='feed-post'> 
            <div class='feed-post-title'>
              <img src='http://i.imgur.com/HQ3YU7n.gif' alt='avatar' class='user-avatar feed-avatar' />
              <span class='feed-name'> Jacob Dickinson <small> Posted 8hr ago </small></span>
              <span class='feed-like'> 
                6 <i class="fa fa-thumbs-up"></i>
              </span>
              <hr /> 

            </div>
            <div class='feed-post-content'>
              Some text text text text 
            </div>
          </div>
          <? } ?>
        </div>
        <div class='feed-notices'> 
          <div class='modulated-box'>
            <h2>Recommendations</h2>
            <?php for($i = 0; $i < 3; $i++ ) { ?>
            <div class='profile-card pure-g model-popup ' data-id='<?= $x['id'] ?>' id='profile_<?= $x['id'] ?>' 
                     data-content='profile' 
                     data-title="<?= $x['name'] ?> <?= $x['surname'] ?>s Profile"
                     data-profile-id='<?= $x['id'] ?>'
                >
                  <h3 class='pure-u-1-1'>
                    <span class='title-text'><?= $x['name'] ?> <?= $x['surname'] ?></span>
                    <div class='add-friend-btn'> <span> Add </span><i class="fa fa-plus-circle"></i></div>
                  </h3>
                  <div class='pure-u-2-5 card-avatar'>
                    <img src='http://i.imgur.com/HQ3YU7n.gif' alt='user avatar' class='user-avatar'/>
                    <em> Member since <span> 23rd Sep 2016 </span></em>
                  </div>
                  <div class='pure-u-3-5 pure-g card-info'>
                    <div class='pure-u-1-2 l-float'> 
                      <strong>Goal</strong>
                      <div class='click-tile click-goal img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/goals/<?= $x['goal'] ?>.png')"
                      title='<?= $Profile->returnGoalChar($x['goal']) ?>'>
                      </div>
                    </div>
                    <div class='pure-u-1-2 l-float'> 
                      <strong>Experience</strong>      
                      <div class='click-tile click-goal img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/length/<?= $x['workout_exp'] ?>.png')"
                      title='<?= $Profile->returnExpChar($x['workout_exp']) ?>'>
                      </div>
                    </div>
                    <div class='pure-u-1-1 l-float'> 
                      <strong>Location</strong> 
                      <span class='location-row'><?= $x_adress[1] ?>, <?= $x_adress[3] ?></span>
                    </div>
                  </div>
                </div>
            <? } ?>
            <div class='clear'> </div>
          </div>
        </div>
      </div>
    </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>