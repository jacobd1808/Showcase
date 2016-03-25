<?php 
  	include "../../../app/config/checkSession.php";
	include "../../../app/config/conn.php"; 

	$Profile = new Profile($conn);
	$User = new User($conn);
	$Rel = new Relation($conn);

	$info = $Profile->fetchProfile($_SESSION['ifitness_id']);

	switch($info['gender']){
		case 1:
			$info['gender'] = "male";
			break;
		case 2:
			$info['gender'] = "female";
			break;
		case 3:
			$info['gender'] = "other";
			break;
	}
?>

<div class='modulated-box vert-center-popup' id='popup-content'> 
	<div class='pure-g' id='profile'>
		<div class='pure-u-5-24 main-info-col'>
			<div class='main-info-col'>
				<img src='http://i.imgur.com/HQ3YU7n.gif' class='avatar' />
				<ul class='basic-list'> 
					<li class='first-tile'> 
						<strong> Age </strong> 
						<div class='click-tile gender-tile tooltip bottom-tooltip' title="<?= $info['age'] ?> Years Old"> 
                  			<div class='vertical-align'><?= $info['age'] ?></div>
                		</div> 
					</li>
					<li class='second-tile'> 
						<strong> Gender </strong> 
						<div class='click-tile gender-tile tooltip bottom-tooltip' title="<?= $info['gender'] ?>"> 
                  			<i class="fa fa-<?= $info['gender'] ?>"></i>
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
                <input type='submit' name='addFriend' id='addFriend' value='Add Friend'/>
			</div>
		</div>
		<div class='pure-u-13-24' id='main-portfolio'>
			<div class='heading left-border l-align'> About </div>
			<div class='about-container scriptHeight' 
				data-parent-ele='popup-content' data-remove-ele='removeHeader'>
				<div class='profile-section'> 
					<strong> Main Information </strong>
					<ul class='main-info-section'> 
						<li> <span> Date Joined </span> 19 . 02 . 16 </li>
						<li> <span> Hometown </span> <?= $Profile->returnLocation($info['latitude'], $info['longitude']) ?>  </li>
						<li> <span> Current Gym </span>  Huddersfield Leisure Center </li>
						<li> <span> Current Weight </span>  170 Lb / 77kg </li>
						<li> <span> Current Body Fat %</span>  15% </li>
					</ul>
				</div>
				<div class='profile-section'> 
					<strong> Personal Bio </strong>
					<div class='bio-section'> 
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
						<p> Some Test Paragraph</p>
					</div>
				</div>
				<div class='profile-section'> 
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
				</div>
			</div>
		</div>
		<div class='pure-u-6-24' id='friendList'>
			<div class='heading no-border l-align removeHeader' id='friendHeader'> Friends </div>
			<ul class='basic-list vert-list profile-member-list scriptHeight' 
				data-parent-ele='popup-content' data-remove-ele='removeHeader'> 
				<?php for($i = 0; $i < 10; $i++ ) { ?>
				<li> 
					<img src='http://i.imgur.com/HQ3YU7n.gif' alt='user avatar' class='user-avatar'/> 
					<strong> Jacob Dickinson </strong>
					<span> Friend since xx xx xx </span>
				</li>
				<? } ?>
			</ul>
		</div>
	</div>
</div>