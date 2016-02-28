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
		Model Popup Functions
	===================================== */ 

	$('body').on('click', '.model-popup', function(){
		var content = $(this).data('content');
		var title = $(this).data('title');
		$('body').append('<div class="model-bg" id="model"> </div>');
		$('#model').load( "app/views/popups/"+content+".php", function() {
			$('#model').fadeIn(250);
			$('#popup-content').prepend('<h1> '+title+'<span id="closeModel" class="close-model"> <i class="material-icons">close</i> </span> </h1>');
			var alignElem = $('.vert-center-popup');
			alignToVerticalCenter(alignElem); 
		});
	});

	// Give something a class of 'popup-tester' and valid popup file name (as a data-content)
	function popupTesting(){
		if ($('.popup-tester').length != 0) {
			var content = $('.popup-tester').data('content');
			$('body').append('<div class="model-bg" id="model"> </div>');
			$('#model').load( "app/views/popups/"+content+".php", function() {
				$('#model').fadeIn(250);
				$('#popup-content').prepend('<h1> Messaging Center <span id="closeModel" class="close-model"> <i class="material-icons">close</i> </span> </h1>');
				var alignElem = $('.vert-center-popup');
				alignToVerticalCenter(alignElem); 
			});
		}
	}

	popupTesting();

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
		Responsive Navigation 
	===================================== */ 

    /*$('#nav-button').sidr({
      name: 'responsive-nav',
      source: '#main-side-bar',
      renaming: false
    });*/

	/* ====================================
		Init
	===================================== */ 

});