<?php 
  include_once "app/config/conn.php";
  $Profile = new Profile($conn);
  $user_profile = $Profile->fetchProfile($_SESSION['ifitness_id']);
  // This just sets active menu 
  function setActive($nav, $page){ 
    if ($nav == $page) { 
      echo 'active';
    } 
  }
?>

<header>
  <nav>
      <ul class='navigation-menu'>
          <li class='logo-cell'> 
            <img src='assets/img/logos/fitconnect-logo.png' alt='fitConnect Logo'/>
          </li>
          <li><a href="index.php" class='main-link <?= setActive('feed', $pageOpt['navName']); ?>'><i class="material-icons">featured_play_list</i> Feed </a></li>
          <li><a href='search.php' class='main-link <?= setActive('search', $pageOpt['navName']); ?>'><i class="material-icons">search</i> Search </a> </li>
          <li><a href="friends.php" class='main-link <?= setActive('friends', $pageOpt['navName']); ?>'><i class="material-icons">sentiment_very_satisfied</i> Friends </a> </li>
      </ul>
      <div class='user-profile-tab'> 
        <a href='#' class='main-link tab-heading model-popup' data-content='profile' data-title='Someones Profile' data-profile-id='<?= $user_profile['id'] ?>'><?= $user_profile['name'] ?> <?= $user_profile['surname'] ?><i class="material-icons">account_circle</i> </a>
        <ul class='user-menu'> 
            <li> <a href='#' class='model-popup' data-content='message-center' data-title='Messaging Center'> 
              Messages 
              <i class="material-icons">message</i> 
              <span class='count-circle'> 1 </span>
            </a></li>
            <li> <a href='#' class='model-popup' data-content='notifications' data-title='Notification Center'>   
              Notifications 
              <i class="material-icons">notifications</i> 
              <span class='count-circle'> 2 </span>
            </a></li>
            <li class='<?= setActive('edit_profile', $pageOpt['navName']); ?>'> <a href='edit_profile.php'> Edit Profile <i class="material-icons">edit</i></a></li>
            <li> <a href='logout.php'> Logout </a></li>
        </ul>
        <!--                   <li><a href="#" class='de-emphasis'><i class="material-icons">play_for_work</i>Logout</a></li> -->
      </div>
  </nav>
  <div class='clear' id='storage-id' data-user-id='<?= $_SESSION['ifitness_id'] ?>'></div>
</header>