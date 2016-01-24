<?php

  // This just sets active menu 
  function setActive($nav, $page){ 
    if ($nav == $page) { 
      echo 'theme-colour-lighten';
    } 
  }
?>

<!-- 
<div id="sidr" class='theme-colour-main'>
  <ul>
    <li><a href="index.php" class='<?php echo setActive('home', $pageOpt['navName']); ?>'>Home</a></li>
   <li><a href="diagnoseProfiles.php" class='<?php echo setActive('track', $pageOpt['navName']); ?>'>Diagnose</a></li>
    <li><a href="info.php" class='<?php echo setActive('info', $pageOpt['navName']); ?>'>Learn</a></li>
    <li><a href="tips.php" class='<?php echo setActive('tips', $pageOpt['navName']); ?>'>Top Tips</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</div>
-->