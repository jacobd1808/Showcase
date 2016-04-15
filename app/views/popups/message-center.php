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

<script>
	$( document ).ready(function() { 
		// Get User ID
		var user_id = localStorage.getItem("userName") 
		// Get User Inbox
		getInbox(user_id);


		$("body").on('click', '.message_header', function(){
			var message_id = $(this).data('message-id');
			getConversation(message_id);
		});	

		$("body").on('click', '#message-reply', function(e){
			e.preventDefault();
			sendMessage();
		});
	});

	function sendMessage(){
		var message = $("#message-text").val();
		var inbox_id = $("#conversation").data('inbox-id');
		$.ajax({
			url : "app/controller/inboxController.php",
			data : { action: 'send_message', message: message, user_id: user_id, inbox_id: inbox_id },
			method : 'POST', 
			success : function(data){
				var results = jQuery.parseJSON(data);

				$("#conversation").append(" \
				<div class='message-list received-msg'>   \
					<div class='message-content pure-g'>  \
						<div class='pure-u-4-24 avatar-tile'> \
							<img src='assets/img/avatars/cropped/"+ results['avatar_url'] +"' alt='user avatar' class='user-avatar'/><br /> \
							<a href=''> "+ results['name'] + " " + results['surname'] + "</a> \
						</div> \
						<div class='pure-u-20-24 message-text'> \
							"+ results['message'] +"  \
							<em> Sent on "+ results['date_sent'] +" </em> \
						</div> \
					</div> \
				</div>");
			}
		});	
	}

	function getInbox(user_id){
		$.ajax({
			url : "app/controller/inboxController.php", 
			data : { action: 'get_inbox', user_id: user_id},
			method : 'POST', 
			success : function(data){
				var results = jQuery.parseJSON(data);
				results.forEach(function(x){
					var name = x['name'] + " " + x['surname'];
					$("#inbox-list").append(" \
					<li class='message_header' data-message-id='"+ x['id'] +"''> \
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

	function getConversation(inbox_id){
		$("#conversation").slideUp(function(){
			$("#conversation").html("");
			$.ajax({
				url : "app/controller/inboxController.php",
				data : { action: 'get_convo', inbox_id: inbox_id },
				method : 'POST',
				success : function(data){
					var results = jQuery.parseJSON(data);
					console.log(results);
					results.forEach(function(x){
						var name = x['name'] + " " + x['surname'];
						$("#message_from").html(name);
						$("#conversation").data('inbox-id', inbox_id);
						$("#conversation").append(" \
						<div class='message-list received-msg'>   \
							<div class='message-content pure-g'>  \
								<div class='pure-u-4-24 avatar-tile'> \
									<img src='assets/img/avatars/cropped/"+ x['avatar_url'] +"' alt='user avatar' class='user-avatar'/><br /> \
									<a href=''> "+ name +"</a> \
								</div> \
								<div class='pure-u-20-24 message-text'> \
									"+ x['message'] +"  \
									<em> Sent on "+ x['date_sent'] +" </em> \
								</div> \
							</div> \
						</div>");
					});	
					
					$("#conversation").slideDown();	
					$("#message-form").slideDown();
				}
			});
		});			
	};
</script>