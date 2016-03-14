<? include "../../../app/config/conn.php"; ?>

<div class='modulated-box vert-center-popup' id='popup-content'> 
	<div class='pure-g searchPref'> 
		<div class='pure-u-1-3'>
			<div class='heading header-font'> 
				Set Goal
			</div>
			<div class='feedback-container'>
	        	<div class='feedback-msg success'>
	        		<i class="fa fa-check"></i>
	        	</div>
        	</div>
			<ul class='basic-list' id='goal-list'>
				<? foreach($goals as $goal) {?>
					<li class='click-tile medium-tile img-tile tooltip bottom-tooltip' 
					  style="background-image:url('assets/img/icons/goals/<?= $goal[1] ?>.png')"
					  data-text-goal='<?= $goal[0] ?>' data-code-goal='<?= $goal[1] ?>' data-type='goal'
					  title='<?= $goal[0] ?>'
					  id='goal_<?= $goal[1] ?>'>

					</li>
	            <? } ?>
            </ul>
		</div>
		<div class='pure-u-1-3'>
			<div class='heading header-font'>
				Set Experience Level
			</div>
			<div class='feedback-container'>
				<div class='feedback-msg success'>
	        		<i class="fa fa-check"></i>
	        	</div>
	        </div>
			<ul class='basic-list' id='experience-list'>
                <? foreach($experience as $length) {?>
                   <li class='click-tile medium-tile img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/length/<?= $length[1] ?>.png')"
                      data-text-goal='<?= $length[0] ?>' data-code-goal='<?= $length[1] ?>' data-type='length'
                      title='<?= $length[0] ?>'
                      id='exp_<?= $length[1] ?>'>
                  </li>
                <? } ?>
			</ul>
		</div>
		<div class='pure-u-1-3'>
			<div class='heading header-font no-border'>
				Set Location 
			</div>
			<div class='feedback-container'>
				<div class='feedback-msg success' style='display: none'>
	        		<i class="fa fa-check"></i>
	        	</div>
	        </div>
			<div class='location-selector p-15' id='location-selector'>
                <input type='text' name='user_location' id='user_location' placeholder='Enter Postcode'/>
                <div class='click-tile action-btn' id='check-postcode'> 
                  <span> Confirm </span>
                </div>

                <span class='divider'> - or - </span> 

                <div class='click-tile full-width-tile action-btn' title='Gets your devices current location'> 
                  <span> Get current location</span>
                  <i class="fa fa-map-marker"></i> 
                </div>
                <div class='clear'> </div>
            </div>
		</div>
	</div>  
</div>

<script> 

	// Helper Function 
	function classToggle(el, parent) {
		if(el.hasClass('active')) { 
			parent.removeClass('active');
		} else { 
			parent.removeClass('active');
			el.addClass('active');
		}
	}

	// Event Listeners 
	$('#goal-list li').click(function() { 
		checkGoalCompleted($(this));
	});

	$('#experience-list li').click(function() { 
		checkExperienceCompleted($(this));
	});

	// Functions 
	function checkGoalCompleted(el) {
		var parent = $('#goal-list li');
		classToggle(el, parent) 
		if (el.parent().find('.active').length != 0) {
			el.parent().parent().find('.feedback-container').slideDown(); 
		} else { 
			el.parent().parent().find('.feedback-container').slideUp(); 
		}
	}

	function checkExperienceCompleted(el) { 
		var parent = $('#experience-list li');
		classToggle(el, parent) 
		if (el.parent().find('.active').length != 0) {
			el.parent().parent().find('.feedback-container').slideDown(); 
		} else { 
			el.parent().parent().find('.feedback-container').slideUp(); 
		}
	}

	function checkLocationCompleted() { 
		// You need to fill this out 
	}

	function checkAll() { 

	}

</script>