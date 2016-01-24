$(function() {

	/* ====================================
		Core
	===================================== */ 

	var t = 'testing';

	$('body').on('click', '.disable', function(e) {
		e.preventDefault();
	})

	/* ====================================
		Popup Functions  // NEEDS WORK - DO NOT DELETE 
	===================================== */ 

	function showPopup(loadFile, id, data_id) { 
		$('#popup-inner').load('app/views/modules/'+loadFile, { id: data_id }, function(){ 
			setTheme()
			$('#popup-container').fadeIn();
			$('#popup-inner').attr('data-id', id);
			var popupInner = $('#popup-inner').height();
			var popupOuter = $('#popup-container').height(); 
			var marginHeight = (popupOuter - popupInner) / 2;
			$('#popup-container #popup-inner').css({'marginTop': marginHeight });
		});
	}

	$('body').on('click', '.closePopup', function() {
		closePopup(); 
	})

	function closePopup(){ 
		$('#popup-container').fadeOut(400, function(){ 
			$('#popup-inner').empty()
		});
	}

	/* ====================================
		Navigation Bar 
	===================================== */ 

	$('#app-menu-left').sidr({
	  onOpen: function(){
	  	$('#app-cover').fadeIn();
	  	setTheme()
	  },
	  onClose: function(){ 
		$('#app-cover').fadeOut();
		setTheme()
	  }
	});

});