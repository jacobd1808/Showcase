<?php 

  include "app/config/checkSession.php";
  include "app/config/conn.php";
  include "app/controller/searchController.php";
  
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
      <?php include_once "app/views/header.php"; ?>
      <div class='view'> 
          <div class='friends-list m-25 modulated-box'> 
            <h2> Friends List </h2>
            <div class='p-10'>
              <?php for($i = 0; $i < 17; $i++ ) { ?>
              <div class='avatar-tile friend-list'> 
                <img src='http://i.imgur.com/HQ3YU7n.gif' alt='user avatar' class='user-avatar'/>
                <a href=''> Jacob Dickinson </a>
                <br /> <br />
              </div>
              <? } ?>
              <div class='clear'> </div>
            </div>
          </div>

      </div>
      <?php include_once "app/views/scripts.php"; ?>
      <script> 

      </script>
    </body>
</html>