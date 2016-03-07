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
    array("Build Muscle", 'bm'),
    array("Loose Fat", "lf"),
    array("Increase Strength", "is"), 
    array("Improve Performance", "ip"),
    array("General Health and Wellbeight", "hw"),
  );

  $experience = array(
    array("Less than 6 month", 'less_6'),
    array("6 - 12 month", "6_12"),
    array("1 - 2 years", "12_24"), 
    array("2 years or more", "24_plus"),
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
                      title='<?= $goal[0] ?>'>
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
                      title='<?= $length[0] ?>'>
                  </li>
                <? } ?>
              </ul>
              <!-- --> 
              <label> Location <span> </span></label>
              <input type='text' name='user_location' id='user_location' placeholder='Your Postcode'/>
            </div>
          </div>
          <div class='search-results m-25'> 
            <!-- --> 
            <div class='profile-card'> 
              <h3> Some Name </h3>
              addfsd f
            </div>

            <div class='profile-card'> 
              <h3> Some Name </h3>
              fsdf ds
            </div>
            <!-- --> 

          </div>

      </div>
      <?php include_once "app/views/scripts.php"; ?>
      <script> 
      $( document ).ready(function() { 

        // Tooltip Init 
        $('.tooltip.bottom-tooltip').tooltipster({
           speed: 100,
           delay: 50,
           position: 'bottom',
           theme: 'cust-tooltip'
        });

        // Click event function 
        $('.click-tile').click(function() { 
          
          if($(this).data('type') == 'goal') { 
            console.log('goal tile clicked');       // When goal tile is clicked 
          } else if ($(this).data('type') == 'length') { 
            console.log('length tile clicked');     // When length tile is clicked 
          }

        })

      });
      </script>
    </body>
</html>