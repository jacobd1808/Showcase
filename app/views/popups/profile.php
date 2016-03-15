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
						<div class='click-tile gender-tile tooltip left-tooltip' title="<?= $info['age'] ?> Years Old"> 
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
		<div class='pure-u-13-24'>
			<div class='heading left-border l-align'> About </div>
			<div class='pure-g'>
				<div class='pure-u-1-2'>
					<div> <strong> Joined: </strong> 19 . 02 . 16</div>
				</div>
				<div class='pure-u-1-2'> 
					<div> <strong> From: </strong> <?= $Profile->returnLocation($info['latitude'], $info['longitude']) ?> </div>
				</div>
			</div>
		</div>
		<div class='pure-u-6-24'>
			<div class='heading no-border l-align'> Friends </div>
			<ul> 
				<li> Someone</li>
				<li> Someone</li>
				<li> Someone</li>
				<li> Someone</li>
			</ul>
		</div>
	</div>
</div>