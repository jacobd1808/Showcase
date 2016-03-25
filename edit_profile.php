<?php 

  include_once "app/config/checkSession.php";
  include_once "app/config/conn.php";
  include "app/controller/indexController.php";
	
  if ( isset($_GET['id'])){
    $profile_id = $_GET['id'];
  } else {
    $profile_id = $_SESSION['ifitness_id'];
  }

	$pageOpt = array(
		"title"			    =>	"FitConnect", 
		'navName' 		  	=> 	"edit_profile", 
		'cssIncludes'	  	=>	" ", 
		"jsIncludes"	 	=>	" ",
	);


?>
<!DOCTYPE html>
    <head>
		<?php include_once "app/views/meta.php";?>
    </head>
    <body>
      <?php include_once "app/views/header.php"; ?>
      <div class='view'> 
        <div class='m-25'>
          <div class='edit-profile-main modulated-box'> 
            <h2> Profile Content </h2>
            <form action='' method='POST' class='pure-g p-10'>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-r-10">
                <label for="u_dd">Date of Birth <span></span></label>
                <input type='text' name='u_dd' id='u_dd' class='small-input' placeholder='dd'/>
                <input type='text' name='u_mm' id='u_mm' class='small-input' placeholder='mm'/>
                <input type='text' name='u_yy' id='u_yy' class='small-input' placeholder='yy'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-l-10">
                 <label for="u_dd">Upload Profile Picture <span></span></label>
                 <div class='click-tile tooltip right-tooltip full-width-tile action-btn' title='Gets your devices current location' style='width: auto'> 
                      <span> Upload</span>
                 </div>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-r-10">
                <label for="u_location">Goals <span></span></label>
                <ul class='basic-list c-align'> 
                  <? foreach($goals as $goal) {?>
                    <li class='click-tile img-tile tooltip bottom-tooltip' 
                        style="background-image:url('assets/img/icons/goals/<?= $goal[1] ?>.png')"
                        data-text-goal='<?= $goal[0] ?>' data-code-goal='<?= $goal[1] ?>' data-type='goal'
                        title='<?= $goal[0] ?>'
                        id='goal_<?= $goal[1] ?>'>

                    </li>
                  <? } ?>
                </ul>
                <input type='hidden' placeholder='Hidden value for goal' />
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-l-10">
                <label for="u_location">Experience <span></span></label>
                <ul class='basic-list c-align'> 
                  <? foreach($experience as $length) {?>
                  <li class='click-tile img-tile tooltip bottom-tooltip' 
                    style="background-image:url('assets/img/icons/length/<?= $length[1] ?>.png')"
                    data-text-goal='<?= $length[0] ?>' data-code-goal='<?= $length[1] ?>' data-type='length'
                    title='<?= $length[0] ?>'
                    id='exp_<?= $length[1] ?>'>
                  </li>
                  <? } ?>
                </ul>
                <input type='hidden' placeholder='Hidden value for expereince' />
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_location">Location <span></span></label>
                <div class='pure-g'>
                  <div class="pure-u-1 pure-u-md-10-24">
                    <input type='text' name='u_location' id='u_gym' class='location-height-input' />
                  </div>
                  <div class='pure-u-1 pure-u-md-4-24'> 
                    <div class='c-align align-or'> - OR - </div>
                  </div>
                  <div class="pure-u-1 pure-u-md-10-24">
                    <div class='click-tile tooltip right-tooltip full-width-tile action-btn' title='Gets your devices current location' style='width: auto'> 
                      <span> Get current location</span>
                      <i class="fa fa-map-marker"></i> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_gym">Current Gym <span></span></label>
                <input type='text' name='u_gym' id='u_gym'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-r-10 relative">
                <label for="u_weight">Current Weight <span></span></label>
                <input type='text' name='u_weight' id='u_weight'/>
                <div class='click-tile tile-text-center tooltip action-btn bottom-tooltip input-btn' title='Click to change to Pounds'> <span>KG</span> </div>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-l-10">
                <label for="u_bodyfat">Current Body Fat % <span></span></label>
                <input type='text' name='u_bodyfat' id='u_bodyfat'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_bodyfat"> Personal Bio <span></span></label>
                <textarea>Some Bio</textarea>
              </div>
              <div class="pure-u-1 pure-u-md-1-1 c-align">
               <input type='submit' name='update' id='update' />
              </div>
            </form>
          </div>
          <div class='edit-profile-images modulated-box'>
            <h2> Gallery Manager </h2>
            <div class='p-10'>
              <div class='click-tile tooltip bottom-tooltip full-width-tile action-btn' title='Uploads to your profile'> 
                  <span> Upload New Image</span>
            </div>
              <div class='image-gallery'> 
              <a class="fancybox image-ratio edit-profile" rel="group" href="assets/img/upload_images/example_img.jpg">
                <img src="assets/img/upload_images/example_img.jpg" alt="" />
              </a>
              <a class="fancybox image-ratio edit-profile" rel="group" href="assets/img/upload_images/example_img.jpg">
                <img src="assets/img/upload_images/example_img.jpg" alt="" />
              </a>
              <a class="fancybox image-ratio edit-profile" rel="group" href="assets/img/upload_images/example_img.jpg">
                <img src="assets/img/upload_images/example_img.jpg" alt="" />
              </a>
              <a class="fancybox image-ratio edit-profile" rel="group" href="assets/img/upload_images/example_img.jpg">
                <img src="assets/img/upload_images/example_img.jpg" alt="" />
              </a>
              <a class="fancybox image-ratio edit-profile" rel="group" href="assets/img/upload_images/example_img.jpg">
                <img src="assets/img/upload_images/example_img.jpg" alt="" />
              </a>
              <div class='clear'> </div>
            </div>
          </div>
        </div>
        <div class='clear'> </div>
      </div>
    	<?php include_once "app/views/scripts.php"; ?>
    </body>
</html>