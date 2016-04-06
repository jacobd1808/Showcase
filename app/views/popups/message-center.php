<?php 
  	include "../../../app/config/checkSession.php";
	include "../../../app/config/conn.php"; 
?>

<div class='modulated-box vert-center-popup' id='popup-content'> 
	<div class='pure-g'>
		<div class='pure-u-7-24'> 
			<div class='heading left-border l-align removeHeader'> Inbox </div>
			<ul class='inbox-list basic-list vert-list scriptHeight' id='inbox-list'
				data-parent-ele='popup-content' data-remove-ele='removeHeader'>
			</ul>
		</div>
		<div class='pure-u-17-24'> 
			<div id='reply-message'>
				<div class='heading left-border l-align'> Message from ..  </div>
					<div class='scriptHeight' data-parent-ele='popup-content' data-remove-ele='removeHeader'>
					<form action='' method='POST' class='p-h-20 pure-g l-align'> 
						<div class='pure-u-1-1 p-v-20'>
							<h4> Title of Message </h4>
							<!-- --> 
							<div class='message-list received-msg'> 
								<div class='message-content pure-g'> 
									<a href='#' class='pure-u-4-24 avatar-tile'>
										<img src='http://i.imgur.com/HQ3YU7n.gif' alt='user avatar' class='user-avatar'/>
										<span> Jacob Dickinson </span>
									</a>
									<div class='pure-u-20-24 message-text'>
									Some Message 
									<em> Sent on xx . xx . xx </em>
									</div>
								</div>
							</div>
							<!-- --> 
							<!-- --> 
							<div class='message-list sent-msg'> <!-- CHANGE CLASS -->  
								<div class='message-content pure-g'> 
									<div class='pure-u-4-24 avatar-tile'>
										<img src='http://i.imgur.com/HQ3YU7n.gif' alt='user avatar' class='user-avatar'/>
										<a href=''> Jacob Dickinson </a>
									</div>
									<div class='pure-u-20-24 message-text'>
									Some Message 
									<em> Sent on xx . xx . xx </em>
									</div>
								</div>
							</div>
							<!-- --> 
			                <textarea placeholder='Message' style='margin-top: 20px'></textarea>
			                <div class='c-align'>
		                		<input type='submit' name='reply' id='reply' value='Reply'/>
		                	</div>
		              	</div>
					</form>
				</div>
				<div id='new-message' style='display: none'>
					<div class='heading left-border l-align'> Write Message ... </div>
					<form action='' method='POST' class='p-h-20 pure-g l-align'> 
						<div class='pure-u-1-1'>
							<label for="m_sendto"> Send To <span></span></label>
							<input type='text' name='m_sendto' id='m_sendto'/>
							<!-- -->
						 	<label for="m_subject"> Subject <span></span></label>
							<input type='text' name='m_subject' id='m_subject'/>
							<!-- -->
			                <label for="u_bodyfat"> Message <span></span></label>
			                <textarea placeholder='Message'></textarea>
						</div>
						<div class="pure-u-1 pure-u-md-1-1 c-align">
		                	<input type='submit' name='update' id='update' value='Send Message'/>
		              	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$( document ).ready(function() { 
		var user_id = <?= $_SESSION['ifitness_id'] ?>;

		getInbox(user_id);

	});

	function getInbox(user_id){
		$.ajax({
			url : "app/controller/inboxController.php", 
			data : { action: 'get_inbox', user_id: user_id},
			method : 'POST', 
			success : function(data){
				var results = jQuery.parseJSON(data);
				results.forEach(function(x){
					var name = getName(x['last_sender']);	
					$("#inbox-list").append(" \
					<li> \
						<div class='type-col tooltip left-tooltip' title='"+ x['title'] +"'> \
							<span> S </span> \
						</div> \
						<big> " + x['title'] +" </big> \
						<strong> " + name + "</strong> \
						<em> 2 Hours Ago </em> \
					</li>");
				});
			}
		});			
	};

	function getName(user_id){
		$.ajax({
			url : "app/controller/inboxController.php",
			data: { action: 'get_name', user_id: user_id},
			method: 'POST',
			success: function(data){
				var results = jQuery.parseJSON(data);
				console.log(results['name']);
			}
		});
	}

</script>