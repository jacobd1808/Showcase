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
		<div class='c-align'>
			<div class='uil-ring-css' style='transform:scale(0.6);'><div></div></div>
		</div>
	</div>
</div>
<script id="profile-template" type="text/x-handlebars-template">
	<div class='pure-g' id='profile' data-id='{{ id }}'>
		<div class='pure-u-5-24 main-info-col'>
			<div class='main-info-col'>
				<img src='{{ checkAvatar avatar_url }}' class='avatar' />
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
						<div class='click-tile img-tile tooltip bottom-tooltip' style="background-image:url('assets/img/icons/goals/<?php echo $info['goal'] ?>.png')" title="<?php echo $Profile->returnGoalChar($info['goal']) ?>"> 
                		</div> 
					</li>
					<li class='fourth-tile'> 
						<strong> Experience </strong> 
						<div class='click-tile img-tile gender-tile tooltip bottom-tooltip' style="background-image:url('assets/img/icons/length/<?php echo $info['workout_exp'] ?>.png')" title="<?php echo $Profile->returnExpChar($info['workout_exp']) ?>"> 
                		</div> 
					</li>
				</ul>
				{{#if own}}
               	<input type='submit' name='sendMessage' id='sendMessage' value='Send Message' class='model-popup dark-color' data-content='message-center' data-title='Messaging Center' data-send-id='{{ id }}'/>

                <input type='submit' name='addFriend' id='friendRequest' value='{{ relation_t }}' data-relation='{{ relation }}'/>
               	{{/if}} 
			</div>
		</div>
		<div class='pure-u-13-24' id='main-portfolio'>
			<div class='heading left-border l-align'> About </div>
			<div class='about-container scriptHeight' 
				data-parent-ele='popup-content' data-remove-ele='removeHeader'>
				<div class='profile-section'> 
					<strong> Main Information </strong>
					<ul class='main-info-section'> 
						<li> <span> Date Joined </span> {{ formatDate register_date }} </li>
						<li> <span> Hometown </span> {{ location }} </li>
						<li> <span> Current Gym </span> {{ gym }} </li>
						{{#if weight_kg}}
						<li> <span> Current Weight </span> {{ weight_lb }} Lb / {{ weight_kg }}kg </li>
						{{/if}}
						{{#if body_fat}}
						<li> <span> Current Body Fat %</span>  {{ body_fat }}% </li>
						{{/if}}
					</ul>
				</div>
				<div class='profile-section'> 
					<strong> Personal Bio </strong>
					<div class='text-section'> 
						{{{ bio }}}
					</div>
				</div>
				<div class='profile-section'> 
					<strong> Images </strong>
					{{#if image_reply}}
					<div class='text-section'>{{ image_reply }}</div>
					{{/if}}
					<div class='image-gallery'>
						{{#each images}} 
						<a class="fancybox image-ratio" rel="group" href="assets/img/gallery_uploads/{{ this }}">
							<img src="assets/img/gallery_uploads/{{ this }}" alt="" />
						</a>
						{{/each}}
						<div class='clear'> </div>
					</div> 
				</div>
			</div>
		</div>
		<div class='pure-u-6-24' id='friendList'>
			<div class='heading no-border l-align removeHeader' id='friendHeader'> Friends </div>
			<ul class='basic-list vert-list profile-member-list scriptHeight' 
				data-parent-ele='popup-content' data-remove-ele='removeHeader'>
				{{#if friends}} 
					{{#each friends}}
					<li>
						<img src='{{ checkAvatar avatar_url }}' alt='user avatar' class='user-avatar model-popup outline-hover' data-content='profile' data-title="{{ friend_name }} {{ friend_lastname }}'s profile" data-profile-id='{{ friend_id }}'/> 
						<strong> {{ friend_name }} {{ friend_lastname }} </strong>
						<span> Friend since {{ formatShortDate friend_date }} </span>
					</li>
					{{/each}} 
				{{else}}
					<li> 
						<strong class='no-friends'> This user currently has no friends </strong>
					</li>
				{{/if}}
			</ul>
		</div>
	</div>
</script>



