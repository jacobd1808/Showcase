<?php 
  	include "../../../app/config/checkSession.php";
	include "../../../app/config/conn.php"; 
?>

<div class='modulated-box vert-center-popup' id='popup-content'> 
	<div class='pure-g searchPref'>
		<div class='pure-u-1-3 set-pref'>
			<div class='heading header-font c-align'> 
				Set Goal
			</div>
			<div class='feedback-container'>
	        	<div class='feedback-msg success'>
	        		<i class="fa fa-check"></i>
	        	</div>
        	</div>
			<ul class='basic-list' id='goal-list'>
				<?php foreach($goals as $goal) {?>
					<li class='click-tile medium-tile img-tile tooltip bottom-tooltip' 
					  style="background-image:url('assets/img/icons/goals/<?php echo $goal[1] ?>.png')"
					  data-text-goal='<?php echo $goal[0] ?>' data-code-goal='<?php echo $goal[1] ?>' data-type='goal'
					  title='<?php echo $goal[0] ?>'
					  id='goal_<?php echo $goal[1] ?>'>
					</li>
	            <?php } ?>
            </ul>
		</div>
		<div class='pure-u-1-3 set-pref'>
			<div class='heading header-font c-align'>
				Set Experience Level
			</div>
			<div class='feedback-container'>
				<div class='feedback-msg success'>
	        		<i class="fa fa-check"></i>
	        	</div>
	        </div>
			<ul class='basic-list' id='experience-list'>
                <?php foreach($experience as $length) {?>
                   <li class='click-tile medium-tile img-tile tooltip bottom-tooltip' 
                      style="background-image:url('assets/img/icons/length/<?php echo $length[1] ?>.png')"
                      data-text-exp='<?php echo $length[0] ?>' data-code-exp='<?php echo $length[1] ?>' data-type='length'
                      title='<?php echo $length[0] ?>'
                      id='exp_<?php echo $length[1] ?>'>
                  </li>
                <?php } ?>
			</ul>
		</div>
		<div class='pure-u-1-3 set-pref'>
			<div class='heading header-font no-border c-align'>
				Set Location 
			</div>
			<div class='feedback-container'>
				<div class='feedback-msg success'>
	        		<i class="fa fa-check"></i>
	        	</div>
	        </div>
			<div class='location-selector p-15' id='location-selector'>
                <input type='text' name='user_location' id='user_location' placeholder='Enter Postcode'/>
                <div class='click-tile action-btn' id='check-postcode'> 
                  <span> Confirm </span>
                </div>

                <span class='divider'> - or - </span> 

                <div class='click-tile full-width-tile action-btn' id='geo_location' title='Gets your devices current location' onClick='checkGeolocation()'> 
                  <span> Get current location</span>
                  <i class="fa fa-map-marker"></i> 
                </div>
                <div class='clear'> </div>
            </div>
		</div>
		<div class='pure-u-1-1 hidden' id='continue-preferences'>
			<br />
			<p> Thank you for providing this information, it will help us find others with similar goals and levels of experience who live around you </p> 
			<input type='submit' value='Continue' name='continue' id="closeModelBtn" class="small-button"/>
		</div>
	</div>  
</div>

<script> 
	var x = $("#location-selector");
	var id = <?php echo json_encode($_SESSION['ifitness_id']) ?>;
	var goalCheck = false;
	var expCheck = false;
	var geoCheck = false;
	var choice;
	var exp;
	var latitude;
	var longitude;
	var postal_code;

	console.log(id);
	// Event Listeners 
	$('#goal-list li').click(function() { 
		checkCompleted($(this), 'goal');
		choice = $(this).data('code-goal');
		checkAll2();

	});

	$('#experience-list li').click(function() { 
		checkCompleted($(this), 'experience');
		exp = $(this).data('code-exp');
		checkAll2();
	});

	$('#geo_location').click(function(){
		checkGeolocation(postal_code);
		checkCompleted($(this), 'geolocation');
	});

	$('#check-postcode').click(function(){
		postal_code = $("#user_location").val();
		if ( hasWhiteSpace(postal_code)){		
			checkPostalCode(postal_code);
			checkCompleted($(this), 'geolocation');
		} else{
			alert("You need to input a space!");
		}			
	});

	// Functions 
	function checkCompleted(el, type) {

		if ( type == 'geolocation'){
			var parent = $('#user_location');
		} else {
			var parent = $('#'+ type + '-list li');
		}

		if(el.hasClass('active')) { 
			parent.removeClass('active');
		} else { 
			parent.removeClass('active');
			el.addClass('active');
		}

		if (el.parent().find('.active').length != 0) {
			el.parent().parent().find('.feedback-container').slideDown(); 

			switch(type){
				case 'goal':  goalCheck = true;
				break;
				case 'experience': expCheck = true;
				break;
				case 'geolocation': geoCheck = true;
				break;
			}

		} else { 
			el.parent().parent().find('.feedback-container').slideUp(); 

			switch(type){
				case 'goal':  goalCheck = false;
				break;
				case 'experience': expCheck = false;
				break;
				case 'geolocation': geoCheck = false;
				break;
			}
		}
	}

	function checkPostalCode(postal_code){
		$.ajax({
			url : "app/controller/ajaxController.php",
			data : { action: 'check_postcode', postal_code: postal_code },
			method : 'POST',
			success : function(data){
					x.html("Postal Code: <b>" + postal_code + "</b>");
				var results = jQuery.parseJSON(data);
				if(results['address'][4] == undefined) {
	                x.html(results['address'][1] + ", " + results['address'][2] + ", " + results['address'][3]);
	            } else { 
	                x.html(results['address'][2] + ", " + results['address'][3] + ", " + results['address'][4]);
	            }	

				latitude = results['lat'];
				longitude = results['lng'];
				checkAll2();
			}
		});
	}

	function checkGeolocation() {
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
						x.html(results[1] + ", " + results[3]);

	                    if(results[4] == undefined) {
	                      x.html(results[1] + ", " + results[2] + ", " + results[3]);
	                    } else { 
	                      x.html(results[2] + ", " + results[3] + ", " + results[4]);
	                    }	 
					}
				});
			    checkAll2();       	
	        });
	    } else {
	        x.innerHTML = "Geolocation is not supported by this browser.";
	    }
	}

	function checkAll2(){

		if ( goalCheck && expCheck && geoCheck){
		setTimeout(function(){ 
			$('.set-pref').slideUp(200, function() { 
				$('#continue-preferences').slideDown(200);
			});
			$.ajax({
				url : "app/controller/ajaxController.php", 
				data : { action: 'create_profile', id: id, workout_exp: exp, goal: choice, latitude: latitude, longitude: longitude },
				method : 'POST', 
				success : function(data){
					console.log(data);
				}
			});
			}, 1000);
		}
	}

	function checkAll() { 
		action = 'edit_profile';

		$.ajax({
			url : "app/controller/ajaxController.php", 
			data : { action: action, profile_id: profile_id, user_id: user_id },
			method : 'POST', 
			success : function(data){
				location.reload();
			}
		});
	}

    // Check for a space
    function hasWhiteSpace(s) {
        return s.indexOf(' ') >= 0;
    }
</script>