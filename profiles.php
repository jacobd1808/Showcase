<?php   
  include_once "app/config/checkSession.php";
  include_once "app/config/conn.php";
	

  if (isset($_GET['profile_id'])) {
    $process = 'Edit';
    $profile_id = $_GET['profile_id'];
    $data = $profiles->fetchProfile($profile_id);
    $userData['colour_theme'] = $data['colour_theme'];
  } else { 
    $process = 'Create';
    $userData['colour_theme'] = $colours['blue'];
  }

  // Empty Feedback
  $feedback = array( "type" => '', "message" => '' ); 
 

	$pageOpt = array(
		"title"			    =>	"Create Family Member ", 
		'navName' 		  	=> 	"profiles", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	" ",
	);

  function getYears($year){ 
    return $year - 1; 
  }

  $months = array(
    'January','February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December',
  );

  function selectColour($setColour, $colour) { 
      if ($setColour == $colour) { 
        return 'active';
      } 
  }

  // On Submit 
  if(isset($_POST['submitProfile'])) { 

    if ($_POST["profile_name"] == '') { 
      $feedback = array( "type" => 'error', "message" => ' <i class="material-icons">error</i> <em>You must enter a name </em>' ); 
    } else if  ($_POST["dob_year"] == '' || $_POST["dob_month"] == '' || $_POST["dob_day"] == '') { 
      $feedback = array( "type" => 'error', "message" => ' <i class="material-icons">error</i> <em>You must enter a date of birth</em>' ); 
    } else if ($_POST["profile_gender"] == '') { 
      $feedback = array( "type" => 'error', "message" => ' <i class="material-icons">error</i> <em>You must select a gender</em>' ); 
    } else { 
      $dob = $_POST["dob_year"].'-'.$_POST["dob_month"].'-'.$_POST["dob_day"]; 
      $data = array(
       "name" => $_POST["profile_name"], 
       "gender" => $_POST["profile_gender"],
       "dob" => date('Y-m-d', strtotime($dob)),
       "theme" => $_POST["profile_theme"],
      );
      if ($process == 'Create') {
        $result = $profiles->createProfile($data, $_SESSION['id']);
      } else { 
        $result = $profiles->editProfile($data, $profile_id);
      }
      if ($result) { 
         if ($process == 'Create') {
         $feedback = array( "type" => 'confirm', "message" => '<i class="material-icons">check</i><em> Family member successfully created </em>' ); 
         } else { 
         $feedback = array( "type" => 'confirm', "message" => '<i class="material-icons">check</i><em> Family member successfully Updated </em>' ); 
         }
         $userData = $profiles->fetchUser($_SESSION['username']);
      } else { 
          $feedback = array( "type" => 'error', "message" => '<i class="material-icons">error</i><em>Something went wrong </em>' ); 
      }
    }
  }

  if (isset($data['dob'])) {
    $orderdate = explode('-', $data['dob']);
    $year_2 = $orderdate[0];
    $month_2   = $orderdate[1];
    $day  = $orderdate[2];
  } else { 
    $year_2 = $month_2 = $day = null; 
  }

?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php"; ?>
    </head>
    <body>
      <?php include_once "app/views/header.php"; ?>
      <div class='sub-header theme-colour-darken'> Set up a family member profile for more personalised tracking!</div>
      <div class='view'> 
        <?php if ($feedback['type'] != '') { ?> 
          <div class='center-align'> 
            <span class='feedback-msg <?php echo $feedback["type"] ?>'> <?php echo $feedback['message'] ?></span>
          </div>
        <?php } ?>
        <!-- --> 
        <form name="profileset" class='custom-form pure-form' method="post" action=''>
          <?php if ($feedback['type'] == 'confirm') { ?>
          <a href='profiles.php' class='theme-colour-darken custom-btn'> Back to Home </a>
          <? } else { ?>
          <div class='vert-seperate'>
            <input type="text" name="profile_name" id ="name" value='<? if(isset($data['profile_name'])) { echo $data['profile_name']; } ?>' maxlength="50" size="30" placeholder='Name'>
          </div>
          <!-- --> 
          <div class="select-circles vert-seperate" id='gender_select'> 
              <strong>Boy <small>or</small> Girl </strong>
              <div class='boy cir <? if(isset($data['gender']) && $data['gender'] == 0) { echo 'theme-colour-main'; } ?>' data-gender-val='0'> </div>
              <div class='girl cir <? if(isset($data['gender']) && $data['gender'] == 1) { echo 'theme-colour-main'; } ?>' data-gender-val='1'> </div>
              <input type='hidden' value='<?php if(isset($data['gender'])) { echo $data['gender']; }  ?>' name='profile_gender' id='profile_gender'/>
          </div>
          <!-- -->
          <div class='vert-seperate'>
            <strong> Birthday </strong>
            <select id="form_dob_day" name="dob_day" class="dob">
              <option value=''>Day</option>
              <?php for($i = 1; $i <= 50; $i++) { ?>
              <option value="<?php echo $i; ?>" <?php if($i == $day) { echo 'selected="selected"'; } ?> ><?php echo $i; ?></option>
              <?php } ?>
            </select>

            <select id="form_dob_month" name="dob_month" class="dob">
              <option value=''>Month</option>
              <?php $m = 1; foreach ($months as $month) { ?>
                <option value="<?php echo $m ?>" <?php if($m == $month_2) { echo 'selected="selected"'; } ?>><?php echo $month; ?></option>
              <?php $m++; } ?>
            </select>

            <select id="form_dob_year" name="dob_year" class="dob">
              <option value=''>Year</option>
              <?php $year = date(Y); for($i = 1; $i <= 50; $i++) { ?> 
              <option value="<?php echo getYears($year); ?>" <?php if(getYears($year) == $year_2) { echo 'selected="selected"'; } ?>><?php echo getYears($year); ?></option>
              <?php $year = $year - 1; } ?>
            </select>
          </div>
  
          <!-- --> 
          <div class='select-circles small-circles vert-seperate' id='colour_select'> 
              <strong>Select Theme </strong>
              <?php $i = 0; foreach($colours as $name => $hex) { 
              if ($i == 4) { echo '<br />'; } 
              if (isset($data['colour_theme'])) { $theme = $data['colour_theme']; } else { $theme = '#4CA5FF'; }
              ?>
              <div class='red cir <?php echo selectColour($theme, $hex); ?>' data-colour-hex='<?php echo $hex ?>' data-colour-name='<?php echo $name ?>'> 
              <i class="material-icons col">check</i>
              </div>
              <?php $i++; } ?>
              <input type='hidden' name='profile_theme' id='profile_theme' value=' <? if ($theme != null) { echo $theme; } else { echo "#4CA5FF"; } ?>'/>
          </div>
          <!-- -->
          <div class='vert-seperate'>
            <input type="submit" value="<?= $process; ?> Profile" class='theme-colour-main' name="submitProfile" />
          </div>
          <? } ?>
        </form>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>