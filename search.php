<?php 

  //include_once "app/config/checkSession.php";
  //include_once "app/config/conn.php";
  //include "app/controller/indexController.php";
  
  $pageOpt = array(
    "title"         =>  "FitConnect", 
    'navName'         =>  "search", 
    'cssIncludes'     =>  " ", 
    "jsIncludes"    =>  " ",
  );

  $goals = array(
    array("Build Muscle", 'bm'),
    array("Loose Fat", "lf"),
    array("Increase Strength", "is"), 
    array("Improve Performance", "ip"),
    array("General Health and Wellbeight", "hw"),
  );

  $experience = array(
    array("Less than 6 month", 'less_6'),
    array("6 - 12 month", "6_12"),
    array("1 - 2 years", "12_24"), 
    array("2 years or more", "24_plus"),
  );

?>
<!DOCTYPE html>
    <head>
    <?php include_once "app/views/meta.php";?>
    </head>
    <body>
      <?php include_once "app/views/header.php"; ?>
      <div class='view'> 
          <div class='filter-options m-25 modulated-box'> 
          <h2> Narrow your search </h2>
            <ul> 
              <? foreach($goals as $goal) {?>
                <li> <?= $goal[0]; ?> </li>
              <? } ?>
            </ul>

            <ul> 
              <? foreach($experience as $length) {?>
                <li> <?= $length[0]; ?> </li>
              <? } ?>
            </ul>

            <ul> 
              <? for($d = 1; $d <= 7; $d++) { ?>
                <li> <?= $d ?> Day<? if ($d != 1 ) { echo 's'; } ?> </li>
              <? } ?>
            </ul>

            <div class='location'> 
              Location 
            </div>
          </div>
      </div>
      <?php include_once "app/views/scripts.php"; ?>
    </body>
</html>