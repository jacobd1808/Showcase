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
                  <li class='click-tile medium-tile img-tile tooltip bottom-tooltip' 
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
                   <li class='click-tile img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/length/<?= $length[1] ?>.png')"
                      data-text-goal='<?= $length[0] ?>' data-code-goal='<?= $length[1] ?>' data-type='length'
                      title='<?= $length[0] ?>'
                      id='exp_<?= $length[1] ?>'>
                  </li>
                <? } ?>
              </ul>
              <!-- --> 
              <label id='location-label'></label>
              <span class='distance-from'> From .. <?= $adress[1] ?>, <?= $adress[3] ?> <i class="fa fa-cog r-float hover" id='toggle-location-display' style='margin-top: 1px'></i> </span>
              <div class='location-selector' id='location-selector'>
                <input type='text' name='user_location' id='user_location' placeholder='Enter Postcode'/>
                <div class='click-tile action-btn'> 
                  <i class="fa fa-angle-right"></i>
                </div>

                <span class='divider'> - or - </span> 

                <div class='click-tile tooltip right-tooltip full-width-tile action-btn' title='Gets your devices current location'> 
                  <span> Get current location</span>
                  <i class="fa fa-map-marker"></i> 
                </div>
                <input type='text' value='1' data-lat='' data-long='' id='location-check'/> 
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
            ?>
                <script>
                  profiles.push("<?= $x['id'] ?>");
                </script>
                <div class='profile-card' id='profile_<?= $x['id'] ?>' data-goal='<?= $x['goal'] ?>' data-exp='<?= $x['workout_exp'] ?>'>
                  <h3 class='model-popup' data-content='profile' data-title='Someones Profile' data-profile-id='3' data-distance='<? echo $Profile->returnDistance($profile_info['latitude'], $profile_info['longitude'], $x['latitude'], $x['longitude']) ?>'>
                    <?= $x['name'] ?> <?= $x['surname'] ?>
                  </h3>


                  &nbsp;Workout Experience: <b><?= $Profile->returnExpChar($x['workout_exp']) ?></b><br />
                  &nbsp;Goals: <b><?= $Profile->returnGoalChar($x['goal']) ?></b><br />
                  &nbsp;Distance: <b><? echo $Profile->returnDistance($profile_info['latitude'], $profile_info['longitude'], $x['latitude'], $x['longitude']) ?></b>
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
            console.log('a');
             locationStatus = 'distance';
          } else if (locationStatus === 'distance') { 
            console.log('b');
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
      
      var currentGoal = 0;
      var currentExp = 0;

      var $grid = $('.search-results').isotope({
         // options
        getSortData: { distance: '[data-distance]' },
        itemSelector: '.profile-card',
        layoutMode: 'fitRows'
      });

      $grid.isotope({ sortBy: 'distance', sortAscending: true})

      $(".click-tile").click(function(){

        var type = $(this).data('type');
        var goal = $(this).data('code-goal');

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
            filter: '*'
          });
        } else {
          $grid.isotope({
            filter: function(){
              var r_goal = $(this).data('goal');
              var r_exp = $(this).data('exp');

              if ( !currentGoal && r_exp == currentExp || !currentExp && r_goal == currentGoal || r_goal == currentGoal && r_exp == currentExp){
                return true;
              } else {
                return false;
              }
            }
          });
        }

        console.log("Goal:" + currentGoal + " Exp:" + currentExp);
      });
      </script>
    </body>
</html>