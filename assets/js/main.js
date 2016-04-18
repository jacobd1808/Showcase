$(function() {

	/* ====================================
		Core
	===================================== */ 

	// For Quick Debugging 
	var t = 'testing';

	$('body').on('click', '.disable', function(e) {
		e.preventDefault();
	})

	function setSession() {
		var userName = $('#storage-id').data('user-id'); 
		localStorage.setItem("userName", userName);
		//console.log(localStorage.getItem("userName"))
	} 

	var user_id = localStorage.getItem("userName") 

	/* ====================================
		Set Element Height
	===================================== */ 

	function setEleHeight() {
		$('.scriptHeight').each(function() {
			var removeHeightSum = 0;
			var removeEle = $(this).data('remove-ele'); 
			var parentEle = $(this).data('parent-ele'); 

			//console.log($('#'+parentEle).height())

			$('.'+removeEle).each(function() {
				removeHeightSum += $(this).outerHeight(); 
			}); 

			var calcHeight = $('#'+parentEle).height() - removeHeightSum;

			$(this).height(calcHeight);

		})
	} 

	/* ====================================
		Model Popup Functions
	===================================== */ 

	$('body').on('click', '.model-popup', function(){
		if ($('#model').length != 0) { 
			$('#model').remove();
		}
		var content = $(this).data('content');
		var title = $(this).data('title');
		var id = $(this).data('profile-id');
		var msg_to = $(this).data('send-id');

		$('body').append('<div class="model-bg" id="model"> </div>');
		$('#model').load( "app/views/popups/"+content+".php", function() {
			$('#model').fadeIn(250);
			$('#popup-content').prepend('<h1 class="removeHeader"> '+title+'<span id="closeModel" class="close-model"> <i class="material-icons">close</i> </span> </h1>');
			// Load Content if Profile 
			if(id) { 
				loadProfileData(id);
			}
			if (content == 'message-center') {
				getInbox(user_id, msg_to);
			}
			var alignElem = $('.vert-center-popup');
			setEleHeight();
			setImageHeight()
			alignToVerticalCenter(alignElem); 
			formatDate();
		});
	});

	// Give something a class of 'popup-tester' and valid popup file name (as a data-content)
	function defaultPopup(){
		if ($('.default-popup').length != 0) {
			var content = $('.default-popup').data('content');
			var title = $('.default-popup').data('title');
			$('body').append('<div class="model-bg" id="model"> </div>');
			$('#model').load( "app/views/popups/"+content+".php", function() {
				$('#model').fadeIn(250, function(){ 
					setImageHeight()
				});
				if (content == 'searchPreferences') {
					$('#popup-content').prepend('<h1 class="removeHeader">'+title+'</h1>');
				} else { 
					$('#popup-content').prepend('<h1 class="removeHeader">'+title+' <span id="closeModel" class="close-model"> <i class="material-icons">close</i> </span> </h1>');
				} 
				var alignElem = $('.vert-center-popup');
				alignToVerticalCenter(alignElem); 
				setImageHeight()
				setEleHeight();
			});
		}
	}

	function loadProfileData(id) { 
		// Fetch Profile via AJAX based on user ID 
		$.ajax({
			method: 'POST', 
			url : "app/controller/ajaxController.php",
         	data : { action: 'fetch_profile', user_id: id },
			success: function(data) {
				// Store Results 
   		        var results = jQuery.parseJSON(data);

   		        if(results['age'] == '2016') { 
   		        	results['age'] = 'N/A';
   		        }
   		        // Adjust weigh in KG
   		        results['weight_kg'] = results['weight'] / 2.2046;
   		        results['weight_kg'] = results['weight_kg'].toFixed(1);

   		        // Mark as FALSE if no weight specified 
   		        if (results['weight_kg'] == 0) { 
   		        	results['weight_kg'] = false;
   		        }
   		        // Mark as FALSE if no BF specified 
   		        if (results['body_fat'] == 0) { 
   		        	results['body_fat'] = false;
   		        }
   		        // Rename if no gym Specified 
   		       	if (results['gym'] == 'No Gym') { 
   		        	results['gym'] = 'No Gym Specified';
   		        }
   		        // Rename if no user has no bio 
   		       	if (results['bio'] == '') { 
   		        	results['bio'] = 'This user currently has no bio';
   		        }
   		        if (results['images'].length == 0) { 
   		        	results['image-reply'] = 'This user currently has no pictures';
   		        } else { 
					results['image-reply'] = false;
   		        }
   		        // Set text name for gender 
   		        if ( results['gender'] == 1){
   		        	results['gender'] = "male";
   		        	results['d_gender'] = "Male";
   		        } else if( results['gender'] == 2){
   		        	results['gender'] = "female";
   		        	results['d_gender'] = "Female";
   		        }

   		        if (results['id'] != localStorage.getItem("userName")) { 
   		        	results['own'] = true; 
   		        } else { 
   		        	results['own'] = false;
   		        }

   		        if (!results['friends'][0]){
   		        	results['friends'] = false;
   		        }
   		        var data = { id: results['id'], age: results['age'], gender: results['gender'], d_gender: results['d_gender'], register_date: results['register_date'], location: results['location'], gym: results['gym'], body_fat: results['body_fat'], weight_lb: results['weight'], weight_kg: results['weight_kg'], bio: results['bio'], friends: results['friends'], relation: results['relation'], relation_t: results['relation_t'], images: results['images'], image_reply: results['image-reply'], avatar_url: results['avatar_url'], own: results['own'] };
				$('#profile-container').empty();
			    var source   = $("#profile-template").html();
				var template = Handlebars.compile(source);
				$('#profile-container').append(template(data));
				setEleHeight();
				setImageHeight()
				alignToVerticalCenter($('.vert-center-popup')); 
			},
			error: function() { 
				console.log('error loading data');
			}
		});
	}

	defaultPopup();

	$('body').on('click', '#closeModel, #closeModelBtn', function(){
	    $('#model').fadeOut(250, function(){ 
			$('#model').remove();
		})
	});

	/* ====================================
		Common Functions 
	===================================== */ 

	$( '.vert-center' ).each(function() {
		alignToVerticalCenter($(this));
	});

	function alignToVerticalCenter(ele){ 
		var pageHeight = $(window).height();
		var eleHeight = $(ele).height();
		var applyMargin = (pageHeight - eleHeight) / 2; 
		ele.css({'marginTop': applyMargin});
	}

	function formatDate() { 
		$( '.format-date' ).each(function() {
			var date = $(this).text(); 
			var formatDate = moment(date).format('MMMM Do YYYY');
			$(this).text(formatDate);
		});
		$( '.format-date-short' ).each(function() {
			var date = $(this).text(); 
			var formatDate = moment(date).format('Do MMM YYYY');
			$(this).text(formatDate);
		});
	}

	/* ====================================
		Tooltips 
	===================================== */ 

	$('body').on('mouseover mouseout', '.tooltip', function(e) {
	 	initTooltips();
	});

	/* ====================================
		Fancy Box Gallery 
	===================================== */  

	$('body').on('click', '.fancybox', function(e) {
		$(".fancybox").fancybox({
			maxWidth: '80%',
			maxHeight: '80%'
		});
	});

	function setImageHeight() {
		$( '.image-ratio' ).each(function() {
			var imageWidth = $('.image-ratio').width(); 
			$('.image-ratio').height(imageWidth); 
		}); 
	}	

	/* ====================================
		Handlebar Helper Functions 
	===================================== */  

	Handlebars.registerHelper('formatDate', function(date) {
  		return new moment(date).format('D MMMM YYYY');
	});

	Handlebars.registerHelper('formatShortDate', function(date) {
  		return new moment(date).format('Do MMM YYYY');
	});


	Handlebars.registerHelper('checkAvatar', function(avt) {
		if (avt != '') {
        	return 'assets/img/avatars/cropped/'+avt; 
    	} else {
        	return 'assets/img/avatars/cropped/no_avatar.gif';
    	}
	});

	/* ====================================
		Inbox Event Listeners 
	===================================== */  

	$("body").on('click', '.message_header', function(){
		var message_id = $(this).data('message-id');
		getConversation(message_id);
	});	

	$("body").on('click', '#message-reply', function(e){
		e.preventDefault();
		sendMessage();
	});

	/* ====================================
		Inbox Event Listeners 
	===================================== */ 

$("body").on("click", "#friendRequest", function(){
	var id = localStorage.getItem("userName") ;

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

	/* ====================================
		Count Notifications and Messages 
	===================================== */

	window.setInterval(function(){
		$('.checkCount').each(function(){ 
			var ele = $(this).attr('id');
			checkForUpdates(ele, user_id); 
		}); 
	}, 5000);

	/* ====================================
		Init
	===================================== */ 

	initTooltips(); 
	setImageHeight();
	setSession();
	formatDate()

});

	function initTooltips() { 
		// Position Array
	 	var pos = ["top", "left", "bottom", "right"];
	 	// Init Tooltip for all directions 
		for (i = 0; i < pos.length; i++) { 
			if (!$('.tooltip.'+pos[i]+'-tooltip').hasClass('tooltipstered')) {
			 	$('.tooltip.'+pos[i]+'-tooltip').tooltipster({
			       speed: 100,
			       delay: 50,
			       position: pos[i],
			       theme: 'cust-tooltip'
		    	});
		 	}
		}
	}

	function checkForUpdates(ele, user_id) { 
		var counterDOM = $('#'+ele).find('span.count-circle');
		$.ajax({
			url : "app/controller/ajaxController.php", 
			data : { action: "check_update", user_id: user_id, type: ele},
			method : 'POST', 
			success : function(data){
				if (data == 0) {
					counterDOM.text('0');
					counterDOM.fadeOut();
				} else { 
					counterDOM.text(data);
					counterDOM.fadeIn();
				}
			}
		});
	}




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

	function startConvo(send_id){
		var user; 
		$.ajax({
			method: 'POST', 
			url : "app/controller/ajaxController.php",
         	data : { action: 'fetch_profile', user_id: send_id },
			success: function(data) {
				user = jQuery.parseJSON(data);
				$("#reply-message").html(" \
					<div id='new-message' data-id='"+ user.id +"'>  \
						<div class='heading left-border l-align'> Message to <strong>"+ user.name +" </strong></div> \
						<div class='p-h-20 pure-g l-align'> \
							<div class='pure-u-1-1'> \
			                	<label for='u_bodyfat'> Message <span></span></label> \
			                	<textarea placeholder='Message' id='new-message-field'></textarea> \
							</div> \
							<div class='pure-u-1 pure-u-md-1-1 c-align'> \
		                		<input type='submit' name='update' id='send-new-message' value='Send Message'/> \
		              		</div>\
						</div> \
					</div>");
					}
		}); 
	}

	$('body').on('click', '#send-new-message', function(e){ 
		e.preventDefault;
		var message = $('#new-message-field').val();
		var to_id = $('#new-message').data('id');
		var from_id = localStorage.getItem("userName"); 
		$.ajax({
			method: 'POST', 
			url : "app/controller/inboxController.php",
         	data : { action: 'start_inbox', msg: message, to_id: to_id, from_id: from_id },
			success: function(data) {
				$('#reply-message').slideUp();
				$("#inbox-list").empty(); 
				getInbox(from_id, null)
			}
		});   
	})

	function getInbox(user_id, send_id){
		if (send_id != undefined) { 
			startConvo(send_id);
		}
		var user_id = localStorage.getItem("userName");
		$.ajax({
			url : "app/controller/inboxController.php", 
			data : { action: 'get_inbox', user_id: user_id},
			method : 'POST', 
			success : function(data){
				console.log(data);
				var results = jQuery.parseJSON(data);
				if (results) {
					results.forEach(function(x){
						var name = x['name'] + " " + x['surname'];
						$("#inbox-list").append(" \
						<li class='message_header' data-message-id='"+ x['id'] +"''> \
							<div class='type-col tooltip left-tooltip' title='"+ x['title'] +"'> \
								<span> S </span> \
							</div> \
							<strong> " + name + "</strong> \
							<em> 2 Hours Ago </em> \
						</li>");
					});
				} else { 
					$("#inbox-list").html('<li> No inbox messages. Click on a members profile to send them a message directly.</li>');
				}
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
	}