<?php

  function setActive($nav, $page){ 
    if ($nav == $page) { 
      echo 'theme-colour-lighten';
    } 
  }
?>
<!-- THIS SETS THE COLOUR THEME --> 
<div id='theme-setter' data-theme-col='<? if(isset($userData['colour_theme'])) { echo $userData['colour_theme']; } else { echo '#4CA5FF';} ?>' data-user-id='<?= $userData['id'] ?>' ></div>
<header class='theme-colour-main <? if($pageOpt['navName'] == 'home') { echo 'no-background'; } ?>'> 
  <? if ($pageOpt['navName'] == 'track_symptoms') { ?>
  <a class='title-left' href='diagnoseRecords.php?profile=<?= $_GET['profile'] ?>'><i class="material-icons">keyboard_arrow_left</i></a>
  <? } else if ($pageOpt['navName'] == 'track_record') { ?>
  <a class='title-left' href='diagnoseProfiles.php'><i class="material-icons">keyboard_arrow_left</i> </a>
  <? } else if ($pageOpt['navName'] == 'profiles') { ?>
  <a class='title-left' href='index.php'><i class="material-icons">keyboard_arrow_left</i> </a>
  <? } else if ($pageOpt['navName'] != 'login') { ?>
  <a class='title-left' id="app-menu-left" href="#sidr-left"><i class="material-icons">&#xE5D2;</i></a>
  <? } ?>
  <div class='title-center'> <?php echo $pageOpt['title'] ?> </div>
  <div class='title-right'> <i class='logo-panda'> </i> </div>
  <div class='clear'></div>
</header>

<div id="sidr" class='theme-colour-main'>
  <ul>
    <li><a href="index.php" class='<?php echo setActive('home', $pageOpt['navName']); ?>'>Home</a></li>
    <!--<li><a href="profiles.php" class='<?php echo setActive('profiles', $pageOpt['navName']); ?>'>Profiles</a></li>-->
    <li><a href="diagnoseProfiles.php" class='<?php echo setActive('track', $pageOpt['navName']); ?>'>Diagnose</a></li>
    <li><a href="info.php" class='<?php echo setActive('info', $pageOpt['navName']); ?>'>Learn</a></li>
    <li><a href="tips.php" class='<?php echo setActive('tips', $pageOpt['navName']); ?>'>Top Tips</a></li>
    <!--<li><a href="find.php" class='<?php echo setActive('find', $pageOpt['navName']); ?>'>Find Local GP's</a></li>-->
    <li><a href="logout.php">Logout</a></li>
  </ul>
</div>