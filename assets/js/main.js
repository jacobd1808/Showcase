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

	$('.model-popup').click(function(){ 
		var content = $(this).data('content');
		$('body').append('<div class="model-bg" id="model"> </div>');
		$('#model').load( "app/views/components/"+content+".php", function() {
			$('#model').fadeIn(250);
			$('#model').append('<div id="closeModel" class="close-model"> <i class="fa fa-times"></i> </div>');
			var alignElem = $('#alignmentContainer');
			alignToVerticalCenter(alignElem); 
		});
	});

	$('body').on('click', '#closeModel', function(){
	    $('#model').fadeOut(250, function(){ 
			$('#model').remove();
		})
	});

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