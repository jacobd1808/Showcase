<?php 

  include_once "app/config/checkSession.php";
  include_once "app/config/conn.php";
  include "app/controller/searchController.php";
  
  $pageOpt = array(
    "title"         =>  "FitConnect", 
    'navName'         =>  "search", 
    'cssIncludes'     =>  "<link rel='stylesheet' href='lib/tooltipster-master/css/tooltipster.css' />", 
    "jsIncludes"    =>  "
      <script type='text/javascript' src='lib/tooltipster-master/js/jquery.tooltipster.js' /></script>",
  );

  $goals = array(
    array("Build Muscle", '1'),
    array("Loose Fat", "2"),
    array("Increase Strength", "3"), 
    array("Improve Performance", "4"),
    array("General Health and Wellbeight", "5"),
  );

  $experience = array(
    array("Less than 6 month", '1'),
    array("6 - 12 month", "2"),
    array("1 - 2 years", "3"), 
    array("2 years or more", "4"),
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
                      style="background-image:url('assets/img/icons/hw.png')"
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
                      style="background-image:url('assets/img/icons/hw.png')"
                      data-text-goal='<?= $length[0] ?>' data-code-goal='<?= $length[1] ?>' data-type='length'
                      title='<?= $length[0] ?>'
                      id='exp_<?= $length[1] ?>'>
                  </li>
                <? } ?>
              </ul>
              <!-- --> 
              <label> Location <span> </span></label>
              <input type='text' name='user_location' id='user_location' placeholder='Your Postcode'/>
            </div>
          </div>
          <div class='search-results m-25'> 
          <script>
            var profiles = [];
          </script>
            <!-- --> 
            <?php 
              foreach($profiles as $x){
                $x['goals'] =  $Profile->fetchAllGoals($x['id']);
            ?>
                <script>
                  profiles.push("<?= $x['id'] ?>");
                </script>
                <div class='profile-card' id='profile_<?= $x['id'] ?>' data-goal='<?= $x['goal'] ?>' data-exp='<?= $x['workout_exp'] ?>'>
                  <h3><?= $x['name'] ?> <?= $x['surname'] ?></h3>
                  &nbsp;Workout Experience: <b><?= $Profile->returnExpChar($x['workout_exp']) ?></b><br />
                  &nbsp;Goals: <b><?= $Profile->returnGoalChar($x['goal']) ?></b><br />
                </div>
            <?php
              }
            ?>
            <!-- --> 

          </div>

      </div>
      <?php include_once "app/views/scripts.php"; ?>
      <script> 
      $( document ).ready(function() { 

        var goal_activated = 0;
        var exp_activated = 0;

        // Tooltip Init 
        $('.tooltip.bottom-tooltip').tooltipster({
           speed: 100,
           delay: 50,
           position: 'bottom',
           theme: 'cust-tooltip'
        });

        // Click event function 
        $('.click-tile').click(function() { 

          // Reset the search
          for( var i = 0; i < profiles.length; i++){
            $("#profile_" + profiles[i]).show();
          }

          if($(this).data('type') == 'goal') { 

            var goal_type = $(this).data('code-goal');    

            if ( goal_activated != 0){
              $("#goal_" + goal_activated).removeClass('active');
            }

            if ( goal_activated == goal_type ){
              goal_activated = 0;
            } else {
              $(this).addClass('active');
              goal_activated = goal_type;
            }

          } else if ($(this).data('type') == 'length') { 

            var exp_type = $(this).data('code-goal');

            if ( exp_activated != 0){
              $("#exp_" + exp_activated).removeClass('active');
            }

            if ( exp_activated == exp_type){
              exp_activated = 0;
            } else {
              $(this).addClass('active');
              exp_activated = exp_type;
            }

          }
          filterSearch(goal_activated, exp_activated, profiles);

        });

        function filterSearch(goal, exp, profiles){
          for( var i = 0; i < profiles.length; i++){

            var person_goal = $("#profile_" + profiles[i]).data('goal');
            var person_exp = $("#profile_" + profiles[i]).data('exp');

            if ( goal != 0 ){
              if ( person_goal != goal ){
                $("#profile_"+ profiles[i]).hide();
              }
            }
            
            if ( exp != 0 ){
              if ( person_exp != exp ){
                $("#profile_" + profiles[i]).hide();
              }
            }

          }
        }
      });
      </script>
    </body>
</html>