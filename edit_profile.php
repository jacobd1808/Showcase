<?php 

  include_once "app/config/checkSession.php";
  include_once "app/config/conn.php";
  include_once "app/controller/editController.php";
	$pageOpt = array(
		"title"			    =>	"FitConnect", 
		'navName' 		  	=> 	"edit_profile", 
		'cssIncludes'	  	=>	'<link rel="stylesheet" href="lib/dropzone/basic.css" type="text/css" /><link rel="stylesheet" href="lib/croppic/assets/css/croppic.css">', 
		"jsIncludes"	 	=>	"<script type='text/javascript' src='lib/dropzone/dropzone.js' /></script><script src='lib/croppic/croppic.min.js'></script>",
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
        <div class='m-25'>
          <div class='edit-profile-main modulated-box'> 
            <h2> Profile Content </h2>
            <!-- --> 
            <div class='outcome' id='outcomeMsg'></div>
            <!-- --> 
            <form action='' method='POST' class='pure-g p-10'>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-r-10">
                <label for="u_dd">Date of Birth <span></span></label>
                <input type='text' name='u_dd' id='u_dd' class='small-input' placeholder='DD' value='<?= $dob[2] ?>'/>
                <input type='text' name='u_mm' id='u_mm' class='small-input' placeholder='MM' value='<?= $dob[1] ?>'/>
                <input type='text' name='u_yy' id='u_yy' class='small-input' placeholder='YYYY' value='<?= $dob[0] ?>'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-l-10">
                  <label for="u_dd">Upload Profile Picture <span></span></label>
                  <div class='avatar-upload-area'> 
                    <div id="avatarCrop"></div>
                  </div>
                    <input type='hidden' id='avatarUrl'  name="avatar_url" value='<?= $profile_info['avatar_url'] ?>'/>
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
              <div class="pure-u-1 pure-u-md-1-1 relative">
                <label for="c_location">Current Location<span></span></label>
                    <div class='c-align' id='c_location' data-lat='<?= $profile_info['latitude'] ?>' data-long='<?= $profile_info['longitude'] ?>'> 
                      <span class='loc'><?= displayLocation($location) ?></span>
                    <div class='click-tile tile-text-center tooltip action-btn bottom-tooltip input-btn' id='changeLocation' data-type='location_change'> <span> Change </span></div>
                  </div>
              </div>
              <div class="pure-u-1 pure-u-md-1-1 hidden" id='location-set-row'>
                <label for="u_location">Edit Location <span></span></label>
                <div class='pure-g'>
                  <div class="pure-u-1 pure-u-md-10-24 relative">
                    <input type='text' name='u_location' id='u_location' class='location-height-input' placeholder='Postcode' />
                    <div class='click-tile tile-text-center tooltip action-btn input-btn' id='postcode_btn'> <span>Find</span> </div>
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
                <input type='text' name='u_gym' id='u_gym' placeholder='Name of gym' value='<?= $profile_info['gym'] ?>'/>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-r-10 relative">
                <label for="u_weight">Current Weight <span></span></label>
                <input type='text' name='u_weight' id='u_weight' placeholder='' value='<?= $profile_info['weight'] ?>'/>
                <div class='click-tile tile-text-center tooltip action-btn bottom-tooltip input-btn' id='weight-type' title='Click to change to Pounds' data-type='KG'> <span>KG</span> </div>
              </div>
              <div class="pure-u-1 pure-u-md-1-2 pure-m-l-10">
                <label for="u_bodyfat">Current Body Fat % <span></span></label>
                <input type='text' name='u_bodyfat' id='u_bodyfat' placeholder='%' value='<?= $profile_info['body_fat']?>'/>
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
            <h2> Photo Gallery </h2>
            <!-- --> 
            <div class='outcome' id='outcomeMsgPicture'></div>
            <!-- --> 
            <div>
              <div class='image-gallery'> 
              <form action="app/controller/uploadScript.php" class="dropzone" id="gallery-dropzone">
                <input type="hidden" name="fileName" id='image_name' 
                  value="<?= $profile_info['name'] ?>_<?= $profile_info['surname'] ?>_<?= $_SESSION['ifitness_id'] ?>" />
              </form>
              <div class='clear'> </div>
            </div>
          </div>
        </div>
        <div class='clear'> </div>
      </div>
    </div>
    	<?php include_once "app/views/scripts.php"; ?>
      <script type='text/javascript'>

      $(function() {

        /* ==============================
          Set Variables 
        ============================== */

        var id = <?= $profile_info['id'] ?>;
        var currentGoal = <?= $profile_info['goal'] ?>;
        var currentExp = <?= $profile_info['workout_exp'] ?>;  
        var dob;
        var day;
        var month;
        var year;
        var gym;
        var weight = $('#u_weight').val(); 
        var body_fat;
        var avatar; 

        /* ==============================
          Helper Functions 
        ============================== */

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

        /* ==============================
          Click Tile Handler 
        ============================== */

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
              
             weight = checkVal('weight', $('#u_weight').val());
             weight = convertWeight("LB", weight);

             $("#u_weight").val(weight);

             // LB Function
            } else if ( click_type == "LB"){
              $(this).data("type", "KG");
              $(this).children().html("KG");

              weight = checkVal('weight', $('#u_weight').val());
              weight = convertWeight("KG", weight);

              $("#u_weight").val(weight);
            } else if (click_type == 'location_change') { 
               $('#location-set-row').slideToggle();
            }

            if (click_type != 'location_change') {
              $("#" + click_type + "_" +active).removeClass('active');
              $(this).addClass("active");
            }
        });

        /* ==============================
          Get Location (Geo Location)
        ============================== */

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
                    if(results[4] == undefined) {
                      $("#c_location").find('span.loc').text(results[1] + ", " + results[2] + ", " + results[3]);
                    } else { 
                      $("#c_location").find('span.loc').text(results[2] + ", " + results[3] + ", " + results[4]);
                    }
                    $('#location-set-row').slideToggle();
                  }
                });   

                });

            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }        
        });

      $("#postcode_btn").click(function(){
        var postal_code = $("#u_location").val();
        $.ajax({
          url : "app/controller/ajaxController.php",
          data : { action: 'check_postcode', postal_code: postal_code },
          method : 'POST',
          success : function(data){
            var results = jQuery.parseJSON(data);
            if(results[4] == undefined ) {
              $("#c_location").find('span.loc').text(results.address[1] + ", " + results.address[2] + ", " + results.address[3]);
            } else { 
              $("#c_location").find('span.loc').text(results.address[2] + ", " + results.address[3] + ", " + results.address[4]);
            }
            latitude = results['lat'];
            longitude = results['lng'];

            $("#c_location").data('lat', latitude);
            $("#c_location").data('long', longitude);  

            $('#location-set-row').slideToggle();
          }
        });      
      });

        /* ==============================
          Update Profile 
        ============================== */

        $("#update").click(function(e){
          e.preventDefault();

          day = $("#u_dd").val();
          month = $("#u_mm").val();
          year = $("#u_yy").val();

          gym = $("#u_gym").val();

          body_fat = $("#u_bodyfat").val();

          if ($("#u_weight").val()){
            weight = $("#u_weight").val();

            if ( $("#weight-type").data("type") == "LB" ){
              weight = convertWeight("KG", weight);
              console.log(weight);
            }          
          } else {
            weight = $('#u_weight').val(); 
          }
            bio = $("#u_bio").val();

            avatar = $('#avatarUrl').val(); 

            dob = year + "-" + month + "-" + day;
            latitude = $("#c_location").data('lat');
            longitude = $("#c_location").data('long');
            $.ajax({
              url : "app/controller/ajaxController.php",
              data : { action: 'edit_profile', id: id, dob: dob, goal: currentGoal, workout_exp: currentExp, latitude: latitude, longitude: longitude, gym: gym, body_fat: body_fat, weight: weight, bio: bio, avatar: avatar},
              method : 'POST',
              success : function(data){
                 displayOutcome('Profile Successfully Updated', 'valid', 'outcomeMsg'); 
              },
              error : function() { 
                displayOutcome('Something went wrong, please try again', 'error', 'outcomeMsg'); 
              }
            });            
        });

        /* ==============================
          Dropzone Multi File Uploader 
        ============================== */

        Dropzone.options.galleryDropzone = {
          maxFilesize: 20,
          addRemoveLinks: true,
          dictRemoveFile: '<i class="fa fa-times"></i>',
          init: function() {
            var myDropzone = this;
            var user_name = $('#image_name').val();
            $.ajax({
              method: 'GET', 
              url : "app/controller/fetchImages.php",
              dataType: "json",
              data : { user_id: user_name },
              success: function(data) {
                $('.dropzone').prepend('<div class="gallery-btn"> Upload a Picture </div>');
                $.each(data, function(key, value){
                    var mockFile = { name: value, size: null };
                    myDropzone.files.push(mockFile);
                    myDropzone.options.addedfile.call(myDropzone, mockFile);
                    myDropzone.createThumbnailFromUrl(mockFile, "assets/img/gallery_uploads/" + value);
                    mockFile.previewElement.classList.add('dz-complete');
                });
              },
              error: function() { 
                displayOutcome('Something went wrong, please try again', 'error', 'outcomeMsgPicture');
              }
            });
            myDropzone.on("complete", function(file) { 
              $('.dz-remove').html('<i class="fa fa-times"></i>'); 
              displayOutcome('Picture successfully uploaded', 'valid', 'outcomeMsgPicture'); 
            });
          },
          removedfile: function(file) {
            var _ref;
            $.ajax({
              method: 'POST', 
              url : "app/controller/deleteImage.php",
              data : { name: file.name },
              success: function(data) {
                displayOutcome('Picture deleted', 'valid', 'outcomeMsgPicture'); 
              },
              error: function() { 
                displayOutcome('Something went wrong, please try again', 'error', 'outcomeMsgPicture');
              }
            });
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
          },
      };

      $("body").on('click', '.gallery-btn', function(){
          $(".dropzone").trigger("click");
      });

      function displayOutcome(msg, type, ele) { 
        $('html, body').animate({ scrollTop: 0 }, 'fast', function(){ 
          $('#'+ele).addClass(type);
          $('#'+ele).html(msg);
          $('#'+ele).slideDown(); 
        });
      }


var cropperOptions = {
  uploadUrl:'lib/croppic/img_save_to_file.php',
  cropUrl:'lib/croppic/img_crop_to_file.php',
  outputUrlId:'avatarUrl',
  rotateControls:false, 
  doubleZoomControls:true,
  loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
  modal: true,
  onError: function() { 
    displayOutcome('Please upload either a JPG, PNG or GIF image', 'error', 'outcomeMsg');
  },
  onAfterImgCrop:   function(){ 
    var avatarURL = $('#avatarUrl').val();
    var user_id = localStorage.getItem("userName") 
      $.ajax({
        method: 'POST', 
        url : "app/controller/ajaxController.php",
        dataType: "json",
        data : { action: 'editAvatarLink', user_id: user_id, avatarURL: avatarURL },
        success: function(data) {
          displayOutcome('Avatar successfully uploaded', 'valid', 'outcomeMsg'); 
        },
        error: function() { 
          displayOutcome('Something went wrong, please try again', 'error', 'outcomeMsgPicture');
        }
    });
  }
};
var cropperHeader = new Croppic('avatarCrop', cropperOptions);
    }); 
      </script>      
    </body>
</html>