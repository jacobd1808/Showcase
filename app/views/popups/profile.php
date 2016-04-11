<?php 
  	include "../../../app/config/checkSession.php";
	include "../../../app/config/conn.php"; 

	$Profile = new Profile($conn);
	$User = new User($conn);
	$Rel = new Relation($conn);

	$info = $Profile->fetchProfile($_SESSION['ifitness_id']);
?>

<div class='modulated-box vert-center-popup' id='popup-content'> 
	<div id='profile-container'> 
	<!-- POPULATE --> Hello
	</div>
</div>
<script id="profile-template" type="text/x-handlebars-template">
	<div class='pure-g' id='profile' data-id='{{ id }}'>
		<div class='pure-u-5-24 main-info-col'>
			<div class='main-info-col'>
				<img src='http://i.imgur.com/HQ3YU7n.gif' class='avatar' />
				<ul class='basic-list'> 
					<li class='first-tile'> 
						<strong> Age </strong> 
						<div class='click-tile gender-tile tooltip bottom-tooltip' title="{{ age }} Years Old"> 
                  			<div class='vertical-align'>{{ age }}</div>
                		</div> 
					</li>
					<li class='second-tile'> 
						<strong> Gender </strong> 
						<div class='click-tile gender-tile tooltip bottom-tooltip' title="{{ d_gender }}"> 
                  			<i class="fa fa-{{ gender }}"></i>
                		</div> 
					</li>
					<li class='third-tile'> 
						<strong> Fitness Goal </strong> 
						<div class='click-tile img-tile tooltip bottom-tooltip' style="background-image:url('assets/img/icons/goals/<?= $info['goal'] ?>.png')" title="<?= $Profile->returnGoalChar($info['goal']) ?>"> 
                		</div> 
					</li>
					<li class='fourth-tile'> 
						<strong> Experience </strong> 
						<div class='click-tile img-tile gender-tile tooltip bottom-tooltip' style="background-image:url('assets/img/icons/length/<?= $info['workout_exp'] ?>.png')" title="<?= $Profile->returnExpChar($info['workout_exp']) ?>"> 
                		</div> 
					</li>
				</ul>
                <input type='submit' name='addFriend' id='friendRequest' value='{{ relation_t }}' data-relation='{{ relation }}'/>
			</div>
		</div>
		<div class='pure-u-13-24' id='main-portfolio'>
			<div class='heading left-border l-align'> About </div>
			<div class='about-container scriptHeight' 
				data-parent-ele='popup-content' data-remove-ele='removeHeader'>
				<div class='profile-section'> 
					<strong> Main Information </strong>
					<ul class='main-info-section'> 
						<li> <span> Date Joined </span> {{ register_date }} </li>
						<li> <span> Hometown </span> {{ location }} </li>
						<li> <span> Current Gym </span>  {{ gym }} </li>
						<li> <span> Current Weight </span>  {{ weight_lb }} Lb / {{ weight_kg }}kg </li>
						<li> <span> Current Body Fat %</span>  {{ body_fat }}% </li>
					</ul>
				</div>
				<div class='profile-section'> 
					<strong> Personal Bio </strong>
					<div class='bio-section'> 
						{{{ bio }}}
					</div>
				</div>
			</div>
		</div>
		<div class='pure-u-6-24' id='friendList'>
			<div class='heading no-border l-align removeHeader' id='friendHeader'> Friends </div>
			<ul class='basic-list vert-list profile-member-list scriptHeight' 
				data-parent-ele='popup-content' data-remove-ele='removeHeader'> 
				{{#each friends}}
				<li> 
					<img src='http://i.imgur.com/HQ3YU7n.gif' alt='user avatar' class='user-avatar'/> 
					<strong> {{ friend_name }} {{ friend_lastname }} </strong>
					<span> Friend since {{ friend_date }} </span>
				</li>
				{{/each}}
			</ul>
		</div>
	</div>
</script>
<script>
$("body").on("click", "#friendRequest", function(){
	var id = <?= $_SESSION['ifitness_id'] ?>;

	var profile_id = $("#profile").data('id');
	var relation = $("#friendRequest").data('relation');
	if (relation == "add-friend"){
		$.ajax({
	    	url : "app/controller/ajaxController.php",
	        data : { action: 'friend_request', user_1: id, user_2: profile_id},
	        method : 'POST',
	        success : function(data){
	        	console.log("Request Sent");
	        	$("#friendRequest").removeClass('add-friend');
	        	$("#friendRequest").addClass('friend-request');
	        	$("#friendRequest").val("Request Pending");
	        	$("#friendRequest").data('relation', 'friend-request');

	        	relation = "friend-request";
	        }
	    }); 
	} else if (relation == "friend-request"){
		$.ajax({
			url: "app/controller/ajaxController.php", 
			data: { action: 'remove_request', user_1: id, user_2: profile_id},
			method: 'POST', 
			success : function(data){
				$("#friendRequest").removeClass('friend-request');
				$("#friendRequest").addClass('friend-add');
				$("#friendRequest").val("Add Friend");
				$("#friendRequest").data('relation', 'add-friend');

				relation = "add-friend";
			}
		});
	} else if ( relation == "friends" ){
		$.ajax({
			url: "app/controller/ajaxController.php", 
			data: { action: 'unfriend_person', user_1: id, user_2: profile_id},
			method: 'POST', 
			success : function(data){
				$("#friendRequest").removeClass('friends');
				$("#friendRequest").addClass('friend-add');
				$("#friendRequest").val("Add Friend");
				$("#friendRequest").data('relation', 'add-friend');

				relation = "add-friend";
			}
		});		
	} else if ( relation == "friend-add" ){
		$.ajax({
			url: "app/controller/ajaxController.php", 
			data: { action: 'accept_request', user_1: id, user_2: profile_id},
			method: 'POST', 
			success : function(data){
				console.log(data);
				$("#friendRequest").removeClass('friend-add');
				$("#friendRequest").addClass('friends');
				$("#friendRequest").val("Unfriend");
				$("#friendRequest").data('relation', 'friends');

				relation = "friends";
			}
		});				
	}
});

/*
	.friend-request: If you sent a friend request to the person
	.friend-add: If the person sent you a friend request
	.friends: if the person is your friend
	.add-friend: To be able to send a friend request
*/

				/* <div class='profile-section'> 
					<strong> Images </strong>
					<div class='image-gallery'> 
						<a class="fancybox image-ratio" rel="group" href="assets/img/upload_images/example_img.jpg">
							<img src="assets/img/upload_images/example_img.jpg" alt="" />
						</a>
						<a class="fancybox image-ratio" rel="group" href="assets/img/upload_images/example_img.jpg">
							<img src="assets/img/upload_images/example_img.jpg" alt="" />
						</a>
						<a class="fancybox image-ratio" rel="group" href="assets/img/upload_images/example_img.jpg">
							<img src="assets/img/upload_images/example_img.jpg" alt="" />
						</a>
						<a class="fancybox image-ratio" rel="group" href="assets/img/upload_images/example_img.jpg">
							<img src="assets/img/upload_images/example_img.jpg" alt="" />
						</a>
						<a class="fancybox image-ratio" rel="group" href="assets/img/upload_images/example_img.jpg">
							<img src="assets/img/upload_images/example_img.jpg" alt="" />
						</a>
						<div class='clear'> </div>
					</div> 
				</div> */