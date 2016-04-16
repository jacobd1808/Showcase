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
		console.log(localStorage.getItem("userName"))
	} 

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
		var content = $(this).data('content');
		var title = $(this).data('title');
		var id = $(this).data('profile-id');
		$('body').append('<div class="model-bg" id="model"> </div>');
		$('#model').load( "app/views/popups/"+content+".php", function() {
			$('#model').fadeIn(250);
			$('#popup-content').prepend('<h1 class="removeHeader"> '+title+'<span id="closeModel" class="close-model"> <i class="material-icons">close</i> </span> </h1>');
			// Load Content if Profile 
			if(id) { 
				loadProfileData(id);
			}
			var alignElem = $('.vert-center-popup');
			setEleHeight();
			setImageHeight()
			alignToVerticalCenter(alignElem); 
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
   		        // Adjust weigh in KG
   		        results['weight_kg'] = results['weight'] / 2.2046;

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

   		        if (!results['friends'][0]){
   		        	results['friends'] = { 0: { friend_name: 'This user has no friends, send him a friend request!' } };
   		        }
   		        var data = { id: results['id'], age: results['age'], gender: results['gender'], d_gender: results['d_gender'], register_date: results['register_date'], location: results['location'], gym: results['gym'], body_fat: results['body_fat'], weight_lb: results['weight'], weight_kg: results['weight_kg'], bio: results['bio'], friends: results['friends'], relation: results['relation'], relation_t: results['relation_t'], images: results['images'], image_reply: results['image-reply'], avatar_url: results['avatar_url'] };

   		        console.log(data);
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

	Handlebars.registerHelper('checkAvatar', function(avt) {
		if (avt != '') {
        	return 'assets/img/avatars/cropped/'+avt; 
    	} else {
        	return 'assets/img/avatars/cropped/no_avatar.gif';
    	}
	});

	/* ====================================
		Init
	===================================== */ 

	initTooltips(); 
	setImageHeight();
	setSession()

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