<?php 

  include_once "app/config/checkSession.php";
  include_once "app/config/conn.php";
  include_once "app/controller/editController.php";
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
                <input type='text' name='u_dd' id='u_dd' class='small-input' placeholder='<?= $dob[2] ?>'/>
                <input type='text' name='u_mm' id='u_mm' class='small-input' placeholder='<?= $dob[1] ?>'/>
                <input type='text' name='u_yy' id='u_yy' class='small-input' placeholder='<?= $dob[0] ?>'/>
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
                    id='length_<?= $length[1] ?>'>
                  </li>
                  <? } ?>
                </ul>
                <input type='hidden' placeholder='Hidden value for expereince' />
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="c_location">Current Location<span></span></label>
                  <div class='c-align align-or' id='c_location' data-lat='<?= $profile_info['latitude'] ?>' data-long='<?= $profile_info['longitude'] ?>'> <?= $location[1] ?>, <?= $location[3] ?></div>
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_location">Edit Location <span></span></label>
                <div class='pure-g'>
                  <div class="pure-u-1 pure-u-md-10-24">
                    <input type='text' name='u_location' id='u_location' class='location-height-input' />
                  </div>
                  <div class='pure-u-1 pure-u-md-4-24'> 
                    <div class='c-align align-or'> - OR - </div>
                  </div>
                  <div class="pure-u-1 pure-u-md-10-24">
                    <div class='click-tile tooltip right-tooltip full-width-tile action-btn' id='get-location' title='Gets your devices current location' style='width: auto'> 
                      <span> Get current location</span>
                      <i class="fa fa-map-marker"></i> 
                    </div>
                  </div>
                </div>
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_gym">Current Gym <span></span></label>
                <input type='text' name='u_gym' id='u_gym' placeholder='<?= $profile_info['gym'] ?>'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-r-10 relative">
                <label for="u_weight">Current Weight <span></span></label>
                <input type='text' name='u_weight' id='u_weight' placeholder='<?= $profile_info['weight'] ?>'/>
                <div class='click-tile tile-text-center tooltip action-btn bottom-tooltip input-btn' id='weight-type' title='Click to change to Pounds' data-type='KG'> <span>KG</span> </div>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-l-10">
                <label for="u_bodyfat">Current Body Fat % <span></span></label>
                <input type='text' name='u_bodyfat' id='u_bodyfat' placeholder='<?= $profile_info['body_fat']?>%'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-1">
                <label for="u_bodyfat"> Personal Bio <span></span></label>
                <textarea id="u_bio"><?= $profile_info['bio'] ?></textarea>
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
      <script>
        var id = <?= $profile_info['id'] ?>;
        var currentGoal = <?= $profile_info['goal'] ?>;
        var currentExp = <?= $profile_info['workout_exp'] ?>;  
        var dob;
        var day;
        var month;
        var year;
        var gym;
        var weight = <?= $profile_info['weight'] ?>;
        var body_fat;

        function checkVal(name, def_val){
          if ( $("#u_" + name).val() ){
            return $("#u_" + name).val();
          } else {
            return def_val;
          }
        }

        function convertWeight(weight, x){
          if ( weight == "LB" ){
            x = x * 2.2046;
          } else if ( weight == "KG" ){
            x = x / 2.2046;
          }

          return x;
        }

        $("#goal_" + currentGoal).addClass('active');
        $("#length_" + currentExp).addClass('active');

        $(".click-tile").click(function(){
            var active;
            click_type = $(this).data("type");
            click_new = $(this).data("code-goal");

            if ( click_type == "goal"){
                active = currentGoal;
                currentGoal = click_new;
            } else if ( click_type == "length"){
                active = currentExp;
                currentExp = click_new;
            // KG Function
            } else if ( click_type == "KG"){
              $(this).data("type", "LB");
              $(this).children().html("LB");
              
             weight = checkVal('weight', <?= $profile_info['weight'] ?>);
             weight = convertWeight("LB", weight);

             $("#u_weight").val(weight);

             // LB Function
            } else if ( click_type == "LB"){
              $(this).data("type", "KG");
              $(this).children().html("KG");

              weight = checkVal('weight', <?= $profile_info['weight'] ?>);
              weight = convertWeight("KG", weight);

              $("#u_weight").val(weight);
            }

            $("#" + click_type + "_" +active).removeClass('active');
            $(this).addClass("active");

        });

        $("#get-location").click(function(){
            if (navigator.geolocation) {
               navigator.geolocation.getCurrentPosition(function(position){

                $("#c_location").data('lat', position.coords.latitude);
                $("#c_location").data('long', position.coords.longitude);  

                 $.ajax({
                  url : "app/controller/ajaxController.php",
                  data : { action: 'return_address', latitude: position.coords.latitude, longitude: position.coords.longitude },
                  method : 'POST',
                  success : function(data){
                    var results = jQuery.parseJSON(data);
                    $("#c_location").html(results[1] + ", " + results[3]);
                  }
                });   

                });

            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }        
        });

        $("#update").click(function(e){
          e.preventDefault();

          if ( $("#u_dd").val() ){
            day = $("#u_dd").val();
          } else {
            day = <?= $dob[2] ?>;
          }

          if ( $("#u_mm").val() ){
            month = $("#u_mm").val();
          } else {
            month = <?= $dob[1] ?>;
          }

          if ( $("#u_yy").val() ){
            year = $("#u_yy").val();
          } else {
            year = <?= $dob[0] ?>;
          }

          

          if ( $("#u_gym").val() ){
            gym = $("#u_gym").val();
          } else {
            gym = "<?= $profile_info['gym'] ?>";
          }

          if ( $("#u_bodyfat").val() ){
            body_fat = $("#u_bodyfat").val();
          } else {
            body_fat = <?= $profile_info['body_fat'] ?>;
          }

          if ($("#u_weight").val()){
            weight = $("#u_weight").val();

            if ( $("#weight-type").data("type") == "KG" ){
              weight = convertWeight("LB", weight);
            }          
          } else {
            weight = <?= $profile_info['body_fat'] ?>
          }

          if ( $("#u_bio").val() ){
            bio = $("#u_bio").val();
          } else {
            bio = "No Profile Yet.";
          }

            dob = year + "-" + month + "-" + day;
            latitude = $("#c_location").data('lat');
            longitude = $("#c_location").data('long');
            $.ajax({
              url : "app/controller/ajaxController.php",
              data : { action: 'edit_profile', id: id, dob: dob, goal: currentGoal, workout_exp: currentExp, latitude: latitude, longitude: longitude, gym: gym, body_fat: body_fat, weight: weight, bio: bio},
              method : 'POST',
              success : function(data){
                 console.log(data);
              }
            });            
        });
      </script>      
    </body>
</html>