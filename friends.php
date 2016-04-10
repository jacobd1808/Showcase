<?php 

  include "app/config/checkSession.php";
  include "app/config/conn.php";
  include "app/controller/friendController.php";
  
  $pageOpt = array(
    "title"         =>  "FitConnect", 
    'navName'         =>  "friends", 
    'cssIncludes'     =>  "", 
    "jsIncludes"    =>  "",
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
          <div class='friends-list m-25 modulated-box'> 
            <h2> Friends List </h2>
            <div class='p-10'>
              <?php foreach($friends as $x) { ?>
              <a href='#' class='avatar-tile friend-list model-popup' data-profile-id='<?= $x['friend_id'] ?>' data-content='profile' data-title="<?= $x['friend_name'] ?> <?= $x['friend_lastname'] ?>s Profile"> 
                <img src='http://i.imgur.com/HQ3YU7n.gif' alt='user avatar' class='user-avatar'/>
                <span> <?= $x['friend_name'] ?> <?= $x['friend_lastname'] ?> </span>
              </a>
              <? } ?>
              <div class='clear'> </div>
            </div>
          </div>
        </div>
      </div>
      <?php include_once "app/views/scripts.php"; ?>
      <script> 

      </script>
    </body>
</html>