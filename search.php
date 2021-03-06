<?php 

  include "app/config/checkSession.php";
  include "app/config/conn.php";
  include "app/controller/searchController.php";
  
  $pageOpt = array(
    "title"         =>  "FitConnect . Search", 
    'navName'         =>  "search", 
    'cssIncludes'     =>  "<link rel='stylesheet' href='lib/jquery-slider/jquery-slider.css' />", 
    "jsIncludes"    =>  "<script src='https://code.jquery.com/ui/1.11.1/jquery-ui.js'></script>
      <script type='text/javascript' src='lib/jquery-slider/jquery-slider.js' /></script>",
  );

?>
<!DOCTYPE html>
    <head>
    <?php include_once "app/views/meta.php";?>
    </head>
    <body style='overflow-y: scroll; overflow-x: hidden'>
      <div id='fixed-bg'> </div>
      <!-- Container -->
      <div id='main-content' data-latitude='<?php echo $profile_info['latitude'] ?>' data-longitude='<?php echo $profile_info['longitude'] ?>' data-current-goal='<?php echo $profile_info['goal'] ?>' data-current-exp='<?php echo $profile_info['workout_exp'] ?>' data-slider='<?php echo $profile_info['distance_slider'] ?>'>
      <?php include_once "app/views/header.php"; ?>
      <!-- View --> 
      <div class='view'> 
          <!-- Filter Menu --> 
          <div class='filter-options m-25 modulated-box'> 
            <h2> Narrow your search </h2>
            <div class='p-10'>
              <!-- GOAL --> 
              <label class='reduce-top-padding'> Fitness Goal <span> </span></label>
              <ul class='basic-list c-align'> 
                <?php foreach($goals as $goal) {?>
                  <li class='click-tile click-goal medium-tile img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/goals/<?php echo $goal[1] ?>.png')"
                      data-text-goal='<?php echo $goal[0] ?>' data-code-goal='<?php echo $goal[1] ?>' data-type='goal'
                      title='<?php echo $goal[0] ?>'
                      id='goal_<?php echo $goal[1] ?>'>
                  </li>
                <?php } ?>
              </ul>
              <!-- EXP --> 
              <label> Training Experience <span> </span></label>
              <ul class='basic-list c-align'> 
                <?php foreach($experience as $length) {?>
                   <li class='click-tile click-goal img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/length/<?php echo $length[1] ?>.png')"
                      data-text-goal='<?php echo $length[0] ?>' data-code-goal='<?php echo $length[1] ?>' data-type='length'
                      title='<?php echo $length[0] ?>'
                      id='exp_<?php echo $length[1] ?>'>
                  </li>
                <?php } ?>
              </ul>
              <!-- CURRENT LOCATION --> 
              <label id=''>Current Location <span> </span></label>
              <span class='distance-from'> From ..<span id='location' data-latitude='<?php echo $profile_info['latitude'] ?>' data-longitude='<?php echo $profile_info['longitude'] ?>'><?php echo $adress[1] ?>, <?php echo $adress[3] ?></span> <i class="fa fa-cog r-float hover" id='toggle-location-display' style='margin-top: 1px'></i> </span>
              <!-- CHANGE LOCATION --> 
              <label id='location-label'>Set Location <span> </span></label>                           
              <div class='location-selector' id='location-selector'>
                <input type='text' name='user_location' id='postcode' placeholder='Enter Postcode'/>
                <div class='click-tile action-btn' id='postcode_location'> 
                  <i class="fa fa-angle-right"></i>
                </div>
                <span class='divider'> - or - </span> 
                <div class='click-tile tooltip right-tooltip full-width-tile action-btn' id='geolocation' title='Gets your devices current location'> 
                  <span> Get current location</span>
                  <i class="fa fa-map-marker"></i> 
                </div>
                <div class='clear'> </div>
              </div>
              <!-- DISTANCE SLIDER -->
              <div class='distance-selector' id='distance-selector' style='display: none'>              
                <div class='p-10'>
                  <div class="slider" id='distance-slider'></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Display and Name Search [ RIGHT ] --> 
          <!-- Search by Name  --> 
          <div class='pure-g search-by'> 
              <div class='pure-u-1-2'> 
                <input type='text' placeholder='Search By Name' id='search-by-name' class='text-search'/>
              </div>
              <div class='pure-u-1-2'> 
                <input type='text' placeholder='Search By Gym' id='search-by-gym' class='text-search'/>
              </div>
          </div> 
          <!-- Search Results  --> 
          <div class='search-results m-25'>
          <script>
            // Profile Filter Array 
            var profiles = [];
          </script>
            <!-- Loop though each member tile and display (VIA PHP) --> 
            <?php 
              foreach($profiles as $x){
                if ( $x['id'] != $profile_info['id']){
                  if ( $x['latitude'] != 0 && $x['longitude'] != 0){
                    $x_adress = $Profile->returnCoordinates($x['latitude'], $x['longitude']);
                  } else {
                    $x_adress = array('No', '', 'Location');
                  }

                if ( $x['goal'] == 0){
                  $x['goal'] = 1;
                }

                if ( $x['workout_exp'] == 0 ){
                  $x['workout_exp'] = 1;
                }

                $online = $Profile->lastOnline($x['online']);
                if ( $online == "Online"){
                    $online = "Currently Online";
                } else {
                    $online = "Last Online ". $online;
                }
            ?>
                <!-- Profile tile --> 
                <div class='profile-card pure-g model-popup iso-glow-hover' data-id='<?php echo $x['id'] ?>' id='profile_<?php echo $x['id'] ?>' 
                     data-distance='0' 
                     data-goal='<?php echo $x['goal'] ?>' 
                     data-exp='<?php echo $x['workout_exp'] ?>' 
                     data-latitude='<?php echo $x['latitude'] ?>' 
                     data-longitude='<?php echo $x['longitude'] ?>'
                     data-name='<?php echo $x['name'] ?> <?php echo $x['surname'] ?>' 
                     data-gym='<?php echo $x['gym'] ?>'
                     data-content='profile' 
                     data-title="<?php echo $x['name'] ?> <?php echo $x['surname'] ?>'s Profile"
                     data-profile-id='<?php echo $x['id'] ?>'
                >
                  <h3 class='pure-u-1-1'>
                    <span class='title-text'><?php echo $x['name'] ?> <?php echo $x['surname'] ?></span>
                  </h3>
                  <div class='pure-u-2-5 card-avatar'>
                    <img src='<?php echo avatarExists($x['avatar_url'] , 'main') ?>' alt='user avatar' class='user-avatar'/>
                    <em><?php echo $online ?></em>
                  </div>
                  <div class='pure-u-3-5 pure-g card-info'>
                    <div class='pure-u-1-2 l-float'> 
                      <strong>Goal</strong>
                      <div class='click-tile click-goal img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/goals/<?php echo $x['goal'] ?>.png')"
                      title='<?php echo $Profile->returnGoalChar($x['goal']) ?>'>
                      </div>
                    </div>
                    <div class='pure-u-1-2 l-float'> 
                      <strong>Experience</strong>      
                      <div class='click-tile click-goal img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/length/<?php echo $x['workout_exp'] ?>.png')"
                      title='<?php echo $Profile->returnExpChar($x['workout_exp']) ?>'>
                      </div>
                    </div>
                    <div class='pure-u-1-1 l-float'> 
                      <strong>Location</strong> 
                      <span class='location-row'><?php echo displayLocation($x_adress) ?></span>
                    </div>
                  </div>
                </div>
            <?php
              } }
            ?>
            <!-- End of profile tile --> 
          </div>
        </div>
      </div>
      <?php include_once "app/views/scripts.php"; ?>
      <script> 
      $( document ).ready(function() { 

        //  ======================
        //  Slider Plugin 
        //  ======================

        $(".slider")
          .slider({ 
              min: 2, 
              max: 10, 
              value: $("#main-content").data('slider'), 
              step: 2 
          })

          .slider("pips", {
              rest: "label",
          });
 
        //  ======================
        //  Location display check function 
        //  ======================

        var val = $('#slider').slider("option", "value");
        var locationStatus = 'location';
        locationInit(); 

        $('#toggle-location-display').click(function(){ 
          if (locationStatus === 'location') {
             locationStatus = 'distance';
          } else if (locationStatus === 'distance') { 
             locationStatus = 'location';
          }
          locationDisplay(locationStatus);
        })
      });

      function locationDisplay(status) { 
        if (status === 'location') {
          $('#location-selector').slideDown();
          $('#distance-selector').slideUp();
          $('#location-label').html('Set Location<span> </span>')
        } else if (status === 'distance') {
          $('#location-selector').slideUp();
          $('#distance-selector').slideDown();
          $('#location-label').html('Set Distance (Miles)<span> </span>');
        }
      }

      //  ======================
      //  Get users details 
      //  ====================== 

      var latitude = $("#main-content").data('latitude');
      var longitude = $("#main-content").data('longitude');
      var currentGoal = $("#main-content").data('current-goal');
      var currentExp = $("#main-content").data('current-exp');
      var id = localStorage.getItem("userName");

      $(".search-results").data('goal', currentGoal);
      $(".search-reults").data('exp', currentExp);

      $("#goal_" + currentGoal).addClass('active');
      $("#exp_" + currentExp).addClass('active');

      
      //  ======================
      //  Calculate distance between users location and each profile tile 
      //  ======================

      function calculateDistance(lat1, long1, lat2, long2){
        var R = 6371; // Radius of the earth in KM.
        var dLat = deg2rad(lat2-lat1);
        var dLong = deg2rad(long2-long1);

        var a = 
          Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
          Math.sin(dLong / 2) * Math.sin(dLong / 2);
          var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
          var d = R * c;
          return d * 0.621371;
      }
      // Assists previous function 
      function deg2rad(deg){
        return deg * (Math.PI / 180);
      }

      // Loop though and display distance 
      $('.profile-card').each(function(){ 
        // Profile Lat / Long 
        var profile_lat = $(this).data('latitude');
        var profile_long = $(this).data('longitude');
        // Personal Lat / Long 
        var latitude = $("#location").data('latitude');
        var longitude = $("#location").data('longitude');
        // Call function 
        var distance = calculateDistance(latitude, longitude, profile_lat, profile_long);
        $(this).data('distance', distance);
      })

      //  ======================
      //  Update distance when user changes there location 
      //  ======================
      function updateDistance(){
        latitude = $("#location").data('latitude');
        longitude = $("#location").data('longitude');

        profiles.forEach(function(x){
          var profile_lat = $("#profile_" + x).data('latitude');
          var profile_long = $("#profile_" + x).data('longitude');
          var distance = calculateDistance(latitude, longitude, profile_lat, profile_long);
          $("#profile_" + x).data('distance', distance);     

          $grid.isotope('updateSortData').isotope();
          $grid.isotope({ sortBy: 'distance', sortAscending: true });               
        })
      }

      //  ======================
      //  Update POSTCODE 
      //  ======================

      $("#postcode_location").click(function(){
        var postal_code = $("#postcode").val();

        if ( hasWhiteSpace(postal_code) ){
          $.ajax({
            url : "app/controller/ajaxController.php",
            data : { action: 'check_postcode', postal_code: postal_code },
            method : 'POST',
            success : function(data){
              $("#location").text(postal_code);
              var results = jQuery.parseJSON(data);

              if(results['address'][4] == undefined) {
                  $("#location").text(results['address'][1] + ", " + results['address'][2] + ", " + results['address'][3]);
              } else { 
                  $("#location").text(results['address'][2] + ", " + results['address'][3] + ", " + results['address'][4]);
              } 

              latitude = results['lat'];
              longitude = results['lng'];

              $("#location").data('latitude', latitude);
              $("#location").data('longitude', longitude);

              updateDistance();
              locationDisplay('distance');
            }
          });    
        } else {
          alert("The Postal code needs a space!");
        }  
      });

      //  ======================
      //  Update GEOLOCATION 
      //  ======================

      $("#geolocation").click(function(){
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position){
                latitude = position.coords.latitude;
                longitude = position.coords.longitude;
                $.ajax({
                  url : "app/controller/ajaxController.php", 
                  data : { action: 'return_address', latitude: latitude, longitude: longitude},
                  method : 'POST', 
                  success : function(data){
                    var results = jQuery.parseJSON(data);
                    if(results[4] == undefined) {
                      $("#location").text(results[1] + ", " + results[2] + ", " + results[3]);
                    } else { 
                      $("#location").text(results[2] + ", " + results[3] + ", " + results[4]);
                    }  
                  }
                }); 
                updateDistance();  
              });
              locationDisplay('distance');

          } else {
              alert("The browser is not compatible with geolocation");
          }
      });

      //  ======================
      //  Init ISOTOPE
      //  ======================

      var $grid = $('.search-results').isotope({
        // options
        getSortData: { distance: function( itemElem ){
                          var distance = $(itemElem).data('distance');
                          return distance;
                        } },
        itemSelector: '.profile-card',
        layoutMode: 'fitRows'
      });   

      //  ======================
      //  Update search when clicking GOAL tile
      //  ======================

      $(".click-goal").click(function(){
        refreshFilter(this);
      });

      //  ======================
      //  Update search when using distance slider 
      //  ======================

      $("#distance-slider").slider({
        change: function( event, ui ) {
          var slider = $("#distance-slider").slider("value");
          $.ajax({
            url : "app/controller/ajaxController.php",
            data : { action: 'update_slider', id: id, slider: slider },
            method : 'POST',
            success : function(data){
            }
          });  
          refreshFilter(this);
        }
      });

      //  ======================
      //  Update search when searching by term
      //  ======================

      $('.text-search').keyup(function(e){
        var id = $(this).attr('id')
        refreshFilter(id); 
      })

      //  ======================
      //  Function to handle all filtering 
      //  ======================

      function refreshFilter(that){
        // Get Values 
        distanceSlider = $("#distance-slider").slider("value");
        var type = $(that).data('type');
        var goal = $(that).data('code-goal');
        var name = $('#search-by-name').val(); 
        var gym = $("#search-by-gym").val(); 

        if (name == '') { 
          name = null; 
        }

        if (gym == '') { 
          gym = null; 
        }

        // Handle Class Change 
        if ( type == 'goal' ){
          if ( currentGoal == goal ){
            $("#goal_" + currentGoal).removeClass('active');
            currentGoal = null;
          } else {
            $("#goal_" + currentGoal).removeClass('active');
            $("#goal_" + goal).addClass('active');
            currentGoal = goal;
          }
        }

        // Handle Length Change 
        if ( type == 'length' ){
          if ( currentExp == goal ){
            $("#exp_" + currentExp).removeClass('active');
            currentExp = null;
          } else {
            $("#exp_" + currentExp).removeClass('active');
            $("#exp_" + goal).addClass('active');
            currentExp = goal;
          }
        }

        // IF user enters a name or gym 
        if (name != null || gym != null) { 
          var searchTerm = $('#'+that).val(); 
          searchTerm = searchTerm.toLowerCase();
          if (that == 'search-by-name') { 
            $grid.isotope({
              filter: function(){
                var r_name = $(this).data('name');
                r_name = r_name.toLowerCase();
                if ( r_name.indexOf(searchTerm) > -1 ){
                  return true;
                } else {
                  return false;
                }
              }
            });
          } else if (that == 'search-by-gym') { 
            $grid.isotope({
              filter: function(){
                var r_gym = $(this).data('gym');
                r_gym = r_gym.toLowerCase();
                if ( r_gym.indexOf(searchTerm) > -1 ){
                  return true;
                } else {
                  return false;
                }
              }
            });
          }
        // If user doesn't have a GOAL or EXP selected 
        } else {
          if ( !currentExp && !currentGoal){
            $grid.isotope({
              filter: function(){
                var r_distance = $(this).data('distance');

                if ( r_distance <= distanceSlider){
                  return true;
                } else {
                  return false;
                }
              }
            });
          } else {
            // If user had GOAL, EXP and Distance selected 
            $grid.isotope({
              filter: function(){
                var r_goal = $(this).data('goal');
                var r_exp = $(this).data('exp');
                var r_distance = $(this).data('distance');

                if ( !currentGoal && r_exp == currentExp || !currentExp && r_goal == currentGoal || r_goal == currentGoal && r_exp == currentExp ){
                  if ( r_distance <= distanceSlider){
                    return true;
                  } else {
                    return false;
                  }
                } else {
                  return false;
                }
              }
            });
          }      
        }  
      }

      // Auto display location 
      function locationInit() {
        var location = $('#location-check').val(); 
        if (location == 1) { 
          locationStatus = 'location';
        } else {  
          locationStatus = 'distance';
        }
        locationDisplay(locationStatus);
      }
      
      // Check for a space
      function hasWhiteSpace(s) {
        return s.indexOf(' ') >= 0;
      }

      updateDistance();   

      </script>
    </body>
</html>