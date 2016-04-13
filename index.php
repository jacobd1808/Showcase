<?php 

  include "app/config/checkSession.php";
  include "app/config/conn.php";
  include "app/controller/indexController.php";

  if ( $profile_info['latitude'] != 0 && $profile_info['longitude'] != 0){
    include "app/controller/recommendationsController.php";

    $count = 0; 
    $recArray = array(); 

    $sameGymCount = count($sameGym);
    $recCount = count($recommendations);


  function checkDistance($myPos, $recPos) { 
    return $dist = getDistance( $myPos['latitude'], $myPos['longitude'], $recPos['latitude'], $recPos['longitude']);
  }

    // Builds Recommendation Array
    if ($sameGymCount < 3) { 
      foreach ($sameGym as $gymRec) { 
          $typeArray = array('type'=>'sameGym');
          $gymRec = array_merge($gymRec, $typeArray);
          array_push($recArray, $gymRec);
          $count++; 
      }
      foreach($recommendations as $rec) { 
        if(!in_array($rec, $recArray)) {
          if(checkDistance($profile_info, $rec) <= 10) {
            if ($count < 3) { 
              $typeArray = array('type'=>'samePreferences');
              $rec = array_merge($rec, $typeArray);
              array_push($recArray, $rec);
              $count++; 
            }
          }
        }
      }
    } else { 
      array_push($recArray, $rec);
    }    
  } else {
    $recArray = 0;
  }


  $pageOpt = array(
    "title"         =>  "Welcome", 
    'navName'         =>  "feed", 
    'cssIncludes'     =>  " ", 
    "jsIncludes"    =>  " ",
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
            <img src='<?= avatarExists($profile_info['avatar_url'] , 'main') ?>' alt='avatar' class='user-avatar feed-avatar' />
            <div> 
              <form action='' method='POST' name='post-status'>
                <textarea name='feed-post' id='feed-post' placeholder='Make a post'></textarea>
                <button class='custom-btn' name='submit-post'> Post </button>
              </form>
            </div>
            <div class='clear'> </div>
          </div>
          <!-- --> 
          <?php foreach($feed as $x) { 
              
            if ( $Relation->checkLike($x['id'], $profile_info['id']) ){
              $data_liked = 1;
            } else {
              $data_liked = 0;
            }

            ?>
          <div class='feed-post'> 

            <div class='feed-post-title'>
              <img src='http://i.imgur.com/HQ3YU7n.gif' alt='avatar' class='user-avatar feed-avatar' />
              <span class='feed-name'> <?= $x['friend_name'] ?> <?= $x['friend_lastname'] ?> <small> Posted <?= $Relation->ago($x['post_time']) ?> </small></span>
              <span class='feed-like'> 
                <span id='count_<?= $x['id'] ?>'><?= $Relation->fetchLikes($x['id']) ?></span> <i class="fa fa-thumbs-up"  data-user-id='<?= $x['friend_id'] ?>' data-id='<?= $x['id'] ?>' data-count='<?= $Relation->fetchLikes($x['id']) ?>' data-liked='<?= $data_liked ?>'></i>
              </span>
              <hr /> 

            </div>
            <div class='feed-post-content'>
              <?= nl2br($x["message"]) ?>
            </div>
          </div>
          <? } ?>
        </div>
        <div class='feed-notices'> 
          <div class='modulated-box'>
            <h2>Recommendations</h2>
            <?php 
            if (count($recArray) == 0 || $recArray == 0) { 
              echo "<div class='outcome notice' id='outcomeMsg' style='display: block'>Unfortunately we are unable to find anyone that matches your preferences right now</div>";
            } else {
              foreach($recArray as $x ) { 
              $address = $Profile->returnCoordinates($x['latitude'], $x['longitude']);
              ?>
              <div class='profile-card pure-g model-popup full-width' data-id='<?= $x['id'] ?>' id='profile_<?= $x['id'] ?>' 
                       data-content='profile' 
                       data-title="<?= $x['name'] ?> <?= $x['surname'] ?>s Profile"
                       data-profile-id='<?= $x['id'] ?>'
                  >
                    <h3 class='pure-u-1-1'>
                      <span class='title-text'><?= $x['name'] ?> <?= $x['surname'] ?></span>
                      <div class='add-friend-btn'> <span> Add </span><i class="fa fa-plus-circle"></i></div>
                    </h3>
                    <div class='pure-u-2-5 card-avatar'>
                      <img src='<?= avatarExists($x['avatar_url'] , 'main') ?>' alt='user avatar' class='user-avatar'/>
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
                        <span class='location-row'><?= $address[1] ?>, <?= $address[3] ?></span>
                      </div>
                    </div>
                    <? if($x['type'] == 'sameGym') { ?>
                      <div class='pure-u-1-1'> 
                        <span class='same-gym-notify'> 
                        <? if($x['type'] == 'sameGym') { echo 'Members of the same Gym'; } ?>
                        </span>
                      </div>
                    <? } ?>
                  </div>
            <? } } ?>
            <div class='clear'> </div>
          </div>
        </div>
      </div>
    </div>
    	<?php include_once "app/views/scripts.php"; ?>
    <script>
      var user_id = <?= $profile_info['id'] ?>;

      $(".fa-thumbs-up").click(function(){
        var like_id = $(this).data('id');
        var liked = $(this).data('liked');
        var count = $(this).data('count');
        var friend_id = $(this).data('user-id');

        console.log(count);
        if ( liked ){
          $.ajax({
            url : "app/controller/ajaxController.php",
            data : { action: 'unlike_feed', user_id: user_id, feed_id: like_id },
            method : 'POST'
          });
          count--;
          $(this).removeClass('liked');
          $(this).data('liked', 0);
          $(this).data('count', count);
          $("#count_" + like_id).html(count);
        } else {
          $.ajax({
            url : "app/controller/ajaxController.php",
            data : { action: 'like_feed', user_id: user_id, feed_id: like_id, friend_id: friend_id },
            method : 'POST'
          });

          $(this).addClass('liked');
          $(this).data('liked', 1);
          count++;
          $(this).data('count', count);
          $("#count_" + like_id).html(count);
        }

        count = 0;
      });
    </script>      
    </body>
</html>