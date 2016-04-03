<?php 

  include "app/config/checkSession.php";
  include "app/config/conn.php";
  include "app/controller/searchController.php";
  
  $pageOpt = array(
    "title"         =>  "FitConnect", 
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
    <body>
      <?php include_once "app/views/header.php"; ?>
      <div class='view'> 
          <div class='filter-options m-25 modulated-box'> 
            <h2> Narrow your search </h2>
            <div class='p-10'>
              <!-- --> 
              <label class='reduce-top-padding'> Goals <span> </span></label>
              <ul class='basic-list c-align'> 
                <? foreach($goals as $goal) {?>
                  <li class='click-tile click-goal medium-tile img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/goals/<?= $goal[1] ?>.png')"
                      data-text-goal='<?= $goal[0] ?>' data-code-goal='<?= $goal[1] ?>' data-type='goal'
                      title='<?= $goal[0] ?>'
                      id='goal_<?= $goal[1] ?>'>

                  </li>
                <? } ?>
              </ul>
              <!-- --> 
              <label> Training Experience <span> </span></label>
              <ul class='basic-list c-align'> 
                <? foreach($experience as $length) {?>
                   <li class='click-tile click-goal img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/length/<?= $length[1] ?>.png')"
                      data-text-goal='<?= $length[0] ?>' data-code-goal='<?= $length[1] ?>' data-type='length'
                      title='<?= $length[0] ?>'
                      id='exp_<?= $length[1] ?>'>
                  </li>
                <? } ?>
              </ul>
              <!-- --> 
              <label id='location-label'></label>
              <span class='distance-from'> From ..<span id='location' data-latitude='<?= $profile_info['latitude'] ?>' data-longitude='<?= $profile_info['longitude'] ?>'><?= $adress[1] ?>, <?= $adress[3] ?></span> <i class="fa fa-cog r-float hover" id='toggle-location-display' style='margin-top: 1px'></i> </span>
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
              <!-- -->
              <div class='distance-selector' id='distance-selector' style='display: none'>              
                <div class='p-10'>
                  <div class="slider" id='distance-slider'></div>
                </div>
              </div>
            </div>
          </div>
          <div class='search-results m-25'> 
          <script>
            var profiles = [];
          </script>
            <!-- --> 
            <?php 
              foreach($profiles as $x){
                if ( $x['id'] != $profile_info['id']){
                  $x_adress = $Profile->returnCoordinates($x['latitude'], $x['longitude']);
            ?>
                <script>
                  profiles.push("<?= $x['id'] ?>");
                </script>
                <div class='profile-card' id='profile_<?= $x['id'] ?>' data-distance='0' data-goal='<?= $x['goal'] ?>' data-exp='<?= $x['workout_exp'] ?>' data-latitude='<?= $x['latitude'] ?>' data-longitude='<?= $x['longitude'] ?>'>
                  <h3 class='model-popup' data-content='profile' data-title='Someones Profile' data-profile-id='3'>
                    <?= $x['name'] ?> <?= $x['surname'] ?>
                  </h3>


                  &nbsp;Workout Experience: <b><?= $Profile->returnExpChar($x['workout_exp']) ?></b><br />
                  &nbsp;Goals: <b><?= $Profile->returnGoalChar($x['goal']) ?></b><br />
                  &nbsp;Location: <b><?= $x_adress[1] ?>, <?= $x_adress[3] ?></b>
                </div>
            <?php
              } }
            ?>
            <!-- --> 

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
              value: 6, 
              step: 2 
          })
          .slider("pips", {
              rest: "label",
          });
 
        //  ======================
        //  Location check function 
        //  ======================

        // This gets the slider value 
        var val = $('#slider').slider("option", "value");

        var locationStatus = 'location';

        locationInit(); 

        function locationInit() {
          var location = $('#location-check').val(); 
          if (location == 1) { 
            locationStatus = 'location';
          } else {  
            locationStatus = 'distance';
          }
          locationDisplay(locationStatus);
        }

        $('#toggle-location-display').click(function(){ 
          //console.log(locationStatus);
          if (locationStatus === 'location') {
             locationStatus = 'distance';
          } else if (locationStatus === 'distance') { 
             locationStatus = 'location';
          }
          locationDisplay(locationStatus);
        })

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
      });

      // Current Latitude & Longitude
      var latitude = <?= $profile_info['latitude'] ?>;
      var longitude = <?= $profile_info['longitude'] ?>;

      // Function to Calculate distance from user to user
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

      // Assistant function to calculateDistance
      function deg2rad(deg){
        return deg * (Math.PI / 180);
      }

      // Calculate distance from every profile
      profiles.forEach(function(x){
        var profile_lat = $("#profile_" + x).data('latitude');
        var profile_long = $("#profile_" + x).data('longitude');
        var distance = calculateDistance(latitude, longitude, profile_lat, profile_long);
        $("#profile_" + x).data('distance', distance);
      });

      // Initiate Isotope Grid
      var $grid = $('.search-results').isotope({
          // options
        getSortData: { distance: function( itemElem ){
                          var distance = $(itemElem).data('distance');
                          return distance;
                        } },
        itemSelector: '.profile-card',
        layoutMode: 'fitRows'
      });

      updateDistance();      

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

      $("#postcode_location").click(function(){
        var postal_code = $("#postcode").val();

        $.ajax({
          url : "app/controller/ajaxController.php",
          data : { action: 'check_postcode', postal_code: postal_code },
          method : 'POST',
          success : function(data){
            $("#location").text(postal_code);
            var results = jQuery.parseJSON(data);

            latitude = results['lat'];
            longitude = results['lng'];

            console.log($("#location").data('longitude'));
            $("#location").data('latitude', latitude);
            $("#location").data('longitude', longitude);

            updateDistance();
          }
        });      
      });

      $("#geolocation").click(function(){
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position){
              latitude = position.coords.latitude;
              longitude = position.coords.longitude;
              $("#location").text("Current Location");  
              updateDistance();  
              });
          } else {
              alert("The browser is not compatible with geolocation");
          }
      });

      var currentGoal = 0;
      var currentExp = 0;

      $(".click-goal").click(function(){
        refreshFilter(this);
      });

      $("#distance-slider").slider({
        change: function( event, ui ) {
          refreshFilter(this);
        }
      });

      function refreshFilter(that){

        console.log("yes");
        distanceSlider = $("#distance-slider").slider("value");
        var type = $(that).data('type');
        var goal = $(that).data('code-goal');

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

        if ( !currentExp && !currentGoal){
          $grid.isotope({
            filter: function(){
              var r_distance = $(this).data('distance');

              if ( r_distance <= distanceSlider / 10){
                return true;
              } else {
                return false;
              }
            }
          });
        } else {
          $grid.isotope({
            filter: function(){
              var r_goal = $(this).data('goal');
              var r_exp = $(this).data('exp');
              var r_distance = $(this).data('distance');

              console.log(r_distance);

              if ( !currentGoal && r_exp == currentExp || !currentExp && r_goal == currentGoal || r_goal == currentGoal && r_exp == currentExp ){
                if ( r_distance <= distanceSlider / 10){
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

        console.log("Goal:" + currentGoal + " Exp:" + currentExp + " Distance: " +  distanceSlider);        
      }
      </script>
    </body>
</html>