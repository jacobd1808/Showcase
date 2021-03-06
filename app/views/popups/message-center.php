<?php 
  	include "../../../app/config/checkSession.php";
	include "../../../app/config/conn.php"; 
?>

<div class='modulated-box vert-center-popup' id='popup-content' data-user-id='<?php echo $_SESSION['ifitness_id'] ?>'> 
	<div class='pure-g'>
		<div class='pure-u-7-24' style='min-height: 700px'> 
			<div class='heading left-border l-align removeHeader'> Inbox </div>
			<ul class='inbox-list basic-list vert-list scriptHeight' id='inbox-list'
				data-parent-ele='popup-content' data-remove-ele='removeHeader'>
			</ul>
		</div>
		<div class='pure-u-17-24'> 
			<div id='reply-message'>
				<div class='heading left-border l-align' id='inbox-head'> Message Feed: <span id='message_from'></span> </div>
					<div class='outcome hidden' id='outcomeMsg-inbox'></div>
					<div class='scriptHeight' id='message-form' data-parent-ele='popup-content' data-remove-ele='removeHeader'>

					<div id='init-msg'> Click on a inbox feed to the left to open up your messages </div>
					<!-- -->
					<div id='start_convo_form'> </div>
					<!-- --> 
					<div id='reply_msg_form' class='hidden'>
						<form action='' method='POST' class='p-h-20 pure-g l-align'> 
							<div class='pure-u-1-1 p-v-20'>

								<div id='conversation' data-inbox-id='0'>
								</div>

				                <textarea id='message-text' placeholder='Message' style='margin-top: 20px'></textarea>
				                <div class='c-align'>
			                		<input type='submit' name='reply' id='message-reply' value='Reply'/>
			                	</div>
			              	</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
