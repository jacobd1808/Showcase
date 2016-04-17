<?php 
  	include "../../../app/config/checkSession.php";
	include "../../../app/config/conn.php"; 
?>

<div class='modulated-box vert-center-popup' id='popup-content' data-user-id='<?= $_SESSION['ifitness_id'] ?>'> 
	<div class='pure-g'>
		<div class='pure-u-7-24'> 
			<div class='heading left-border l-align removeHeader'> Inbox </div>
			<ul class='inbox-list basic-list vert-list scriptHeight' id='inbox-list'
				data-parent-ele='popup-content' data-remove-ele='removeHeader'>
			</ul>
		</div>
		<div class='pure-u-17-24'> 
			<div id='reply-message'>
				<div class='heading left-border l-align'> Message from .. <span id='message_from'></span> </div>
					<div class='scriptHeight' id='message-form' data-parent-ele='popup-content' data-remove-ele='removeHeader'>
					<form action='' method='POST' class='p-h-20 pure-g l-align'> 
						<div class='pure-u-1-1 p-v-20'>
							<h4 id='message_title'> Title of Message </h4>
							<!-- --> 
							<div id='conversation' data-inbox-id='0'>
							</div>
							<!-- --> 
			                <textarea id='message-text' placeholder='Message' style='margin-top: 20px'></textarea>
			                <div class='c-align'>
		                		<input type='submit' name='reply' id='message-reply' value='Reply'/>
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
		                	<input type='submit' name='update' id='send-message' value='Send Message'/>
		              	</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
