<?php include_once "app/config/checkSession.php";
  include_once "app/config/conn.php";

  $profileData = $profiles->fetchAllProfiles($_SESSION['id']); 
	
	$pageOpt = array(
		"title"			    =>	"Hi, ".$userData['name']. "!", 
		'navName' 		  	=> 	"home", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	" ",
	);

  $month = date("n");
  if ($month >= 1 && $month <= 6) { 
    $mnt = 1; 
  } else { 
    $mnt = 2;
  }
  $tips = new Tips($conn); 
  $tipsList = $tips->fetchMonthsTip($mnt);

?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php";?>
    </head>
    <body>
      <?php include_once "app/views/header.php"; ?>
      <div class='view no-padding'> 
        <div id='pre-login' class='top-tip theme-colour-main'> 
          <div class='home-tip-content'> 
          <?= $tipsList['description']; ?>
          </div>
          <div class='profile-list home-list' id='select-profile'> 
            <div class='sub-header theme-colour-darken' style='margin-bottom: 10px'> Choose a family member to change my theme! </div>
            <? foreach($profileData as $profile) { ?>
              <div class='profile-row <? if (isset($userData['profile_id'])) { if ($profile['profile_id'] == $userData['profile_id']) { echo 'active theme-colour-lighten'; } } ?>' 
                   data-profile-id='<?= $profile['profile_id']; ?>' data-profile-color='<?= $profile['colour_theme']; ?>'> 
                  <div class='cir <?= setGender($profile['gender']) ?>' style='background-color: <?= $profile['colour_theme'] ?>'> </div>
                  <span class='profile-name'><?= $profile['profile_name']; ?></span>
                  <span class='profile-action profile-delete'> <i class="material-icons">close</i> </span>
                  <a href='profiles.php?profile_id=<?= $profile['profile_id']; ?>' class='profile-action profile-update'><i class="material-icons">remove_red_eye</i> </a>
              </div>
            <? } ?>
            <div class='custom-form' style='border-top: 1px solid #ccc; margin-top: 10px'>
              <a href='profiles.php' class='theme-colour-darken custom-btn' style='margin-top: 15px'> Add Family Member! </a>
            </div>
          </div>
        </div>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>