<? include "../../../app/config/conn.php"; ?>

<div class='modulated-box vert-center-popup' id='popup-content'> 
	<div class='pure-g' id='profile'>
		<div class='pure-u-5-24 main-info-col'>
			<div class='main-info-col'>
				<img src='http://i.imgur.com/HQ3YU7n.gif' class='avatar' />
				<ul class='basic-list'> 
					<li class='first-tile'> 
						<strong> Age </strong> 
						<div class='click-tile gender-tile tooltip left-tooltip' title="Male"> 
                  			<div class='vertical-align'>19</div>
                		</div> 
					</li>
					<li class='second-tile'> 
						<strong> Gender </strong> 
						<div class='click-tile gender-tile tooltip bottom-tooltip' title="Male"> 
                  			<i class="fa fa-male"></i>
                		</div> 
					</li>
					<li class='third-tile'> 
						<strong> Fitness Goal </strong> 
						<div class='click-tile img-tile tooltip bottom-tooltip' style="background-image:url('assets/img/icons/goals/1.png')" title="Name of goal"> 
                		</div> 
					</li>
					<li class='fourth-tile'> 
						<strong> Experience </strong> 
						<div class='click-tile img-tile gender-tile tooltip bottom-tooltip' style="background-image:url('assets/img/icons/length/1.png')" title="Experience .."> 
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
					<div> <strong> From: </strong> Huddersfield, United Kingdom </div>
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