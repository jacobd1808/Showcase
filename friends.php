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
            <?php if(isset($feedback)) { 
              echo "<div class='outcome ".$feedback['type']."'>".$feedback['message']."</div>"; 
            } ?>
            <div class='p-10'>
              <?php if (count($friends) != 0) { 
              foreach($friends as $x) { ?>
              <a href='#' class='avatar-tile friend-list model-popup glow-hover' data-profile-id='<?php echo $x['friend_id'] ?>' data-content='profile' data-title="<?php echo $x['friend_name'] ?> <?php echo $x['friend_lastname'] ?>s Profile"> 
                <img src='<?php echo avatarExists($x['avatar_url'] , 'main') ?>' alt='user avatar' class='user-avatar'/>
                <span> <?php echo $x['friend_name'] ?> <br /><?php echo $x['friend_lastname'] ?> </span>
              </a>
              <?php } } else { ?>
                <p> You currently have no friends </p>
              <?php } ?>
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