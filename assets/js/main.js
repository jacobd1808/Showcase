$(function() {

	/* ====================================
		Core
	===================================== */ 

	// For Quick Debugging 
	var t = 'testing';

	$('body').on('click', '.disable', function(e) {
		e.preventDefault();
	})

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
			// alignToVerticalCenter(alignElem); 
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
				$('#popup-content').prepend('<h1 class="removeHeader">'+title+' <span id="closeModel" class="close-model"> <i class="material-icons">close</i> </span> </h1>');
				var alignElem = $('.vert-center-popup');
				alignToVerticalCenter(alignElem); 
				setImageHeight()
				setEleHeight();
			});
		}
	}

	function loadProfileData(id) { 

		var data = {type:"Fiat", model:"500", color:"white"};
		
		$.ajax({
			method: 'POST', 
			url : "app/controller/ajaxController.php",
         	 data : { action: 'fetch_profile', user_id: id },
			success: function(data) {
   		        var results = jQuery.parseJSON(data);

   		        // Adjust weigh in KG
   		        results['weight_kg'] = results['weight'] / 2.2046;
   		        // Adjust gender
   		        if ( results['gender'] == 1){
   		        	results['gender'] = "male";
   		        	results['d_gender'] = "Male";
   		        } else if( results['gender'] == 2){
   		        	results['gender'] = "female";
   		        	results['d_gender'] = "Female";
   		        }

   		        if (!results['friends'][1]){
   		        	results['friends'] = { 1: { friend_name: 'This user has no friends, send him a friend request!' } };
   		        }

   		        console.log(results['friends']);

   		        var data = { age: results['age'], gender: results['gender'], d_gender: results['d_gender'], register_date: results['register_date'], location: results['location'], gym: results['gym'], body_fat: results['body_fat'], weight_lb: results['weight'], weight_kg: results['weight_kg'], bio: results['bio'], friends: results['friends'] };

				$('#profile-container').empty();
			    var source   = $("#profile-template").html();
				var template = Handlebars.compile(source);
				$('#profile-container').append(template(data));
			},
			error: function() { 
				console.log('error loading data');
			}
		});
	}

	defaultPopup();

	$('body').on('click', '#closeModel', function(){
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
	/*
	 $('body').on('mouseover mouseout', '.tooltip', function(e) {
	    $('.tooltip.left-tooltip').tooltipster({
	       speed: 100,
	       delay: 50,
	       position: 'left',
	       theme: 'cust-tooltip'
	    });

	    $('.tooltip.right-tooltip').tooltipster({
	       speed: 100,
	       delay: 50,
	       position: 'right',
	       theme: 'cust-tooltip'
	    });

	  	$('.tooltip.bottom-tooltip').tooltipster({
		   speed: 100,
		   delay: 50,
		   position: 'bottom',
		   theme: 'cust-tooltip'
		});

	  	$('.tooltip.top-tooltip').tooltipster({
		   speed: 100,
		   delay: 50,
		   position: 'top',
		   theme: 'cust-tooltip'
		});
	});
	*/
	/* ====================================
		Fancy Box Gallery 
	===================================== */  

	$('body').on('click', '.fancybox', function(e) {
		$(".fancybox").fancybox();
	});

	function setImageHeight() {
		$( '.image-ratio' ).each(function() {
			var imageWidth = $('.image-ratio').width(); 
			$('.image-ratio').height(imageWidth); 
		}); 
	}	

	setImageHeight();

    /*$('#nav-button').sidr({
      name: 'responsive-nav',
      source: '#main-side-bar',
      renaming: false
    });*/

	/* ====================================
		Init
	===================================== */ 

});