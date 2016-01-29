$(function() {

	/* ====================================
		Core
	===================================== */ 

	var t = 'testing';

	function LightenDarkenColor(col, amt) {
	    var usePound = false;
	    if (col[0] == "#") {
	        col = col.slice(1);
	        usePound = true;
	    }
	    var num = parseInt(col,16);
	    var r = (num >> 16) + amt;
	    if (r > 255) r = 255;
	    else if  (r < 0) r = 0;

	    var b = ((num >> 8) & 0x00FF) + amt;
	    if (b > 255) b = 255;
	    else if  (b < 0) b = 0;

	    var g = (num & 0x0000FF) + amt;
	    if (g > 255) g = 255;
	    else if (g < 0) g = 0;

	    return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);
	}

	$('body').on('click', '.disable', function(e) {
		e.preventDefault();
	})

	/* ====================================
		Popup Functions 
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

	/* ====================================
		Theme Setter
	===================================== */ 

	function fetchThemeColours(){ 
		main_col = $('#theme-setter').data('theme-col'); 
		lighten_col = LightenDarkenColor(main_col, 20);
		darken_col = LightenDarkenColor(main_col, -20);
		darkest_col = LightenDarkenColor(main_col, -40);
		return {
	        main: main_col,
	        lighten: lighten_col,
	       	darken: darken_col,
	        darkest: darkest_col, 
    	};
	} 

	function setTheme(){
		var colours = fetchThemeColours();
		$('.theme-colour-main').animate({'backgroundColor': colours.main}, 200);
		$('.theme-colour-darken').animate({'backgroundColor': colours.darken}, 200);
		$('.theme-colour-lighten').animate({'backgroundColor': colours.lighten}, 200);

		$('.theme-colour').animate({'color': colours.main}, 200);
		$('.theme-border').css({'borderColor': colours.main});

		$('#sidr li').animate({'borderBottomColor': colours.lighten}, 200);
	}

	/* ====================================
		Page Specific - Index
	===================================== */ 

	$( "#select-profile.home-list .profile-row" ).click(function() {
		$('#select-profile .profile-row').removeClass('active theme-colour-lighten');
		$('#select-profile .profile-row').animate({'backgroundColor': '#ddd'}, 0);
		$(this).addClass('active theme-colour-lighten');
		var profile_col = $(this).data('profile-color');
		
		$('#theme-setter').data('theme-col', profile_col);
		setTheme() 
		var action = 'update_profiles';
		var user_id = $('#theme-setter').data('user-id');
		var profile_id = $(this).data('profile-id');
		$.ajax({
			url : "app/controller/ajaxController.php", 
			data : { action: action, user_id: user_id, profile_id: profile_id },
			method : 'POST', 
			success : function(data){
				//
			}
		});
	}); 

	$( "#select-profile .profile-row .profile-delete" ).click(function(e) {
		  var delete_id = $(this).parent().data('profile-id');
		  showPopup('profileDelete.php', delete_id, null);
	}); 

	$( "#select-profile .profile-row .profile-action" ).click(function(e) {
 		e.stopPropagation();
	});

	$('body').on('click', '.confirmDelete', function() {
		var user_id = $('#theme-setter').data('user-id');
		var profile_id = $('#popup-inner').data('id');
		var action = 'delete_profile';
		$.ajax({
			url : "app/controller/ajaxController.php", 
			data : { action: action, profile_id: profile_id, user_id: user_id },
			method : 'POST', 
			success : function(data){
				location.reload();
			}
		});
	});

	/* ====================================
		Page Specific - Profiles 
	===================================== */ 

	// Change colour of circles based off HEX value
	$( "#colour_select div" ).each(function( index ) {
  		var colour = $(this).data('colour-hex');
  		$(this).css({'backgroundColor': colour})
	});

	// Change theme of page when selecting colour value
	$( "#colour_select div" ).click(function(){
		var colour = $(this).data('colour-hex');
		$('#theme-setter').data('theme-col', colour);
		setTheme();
	});

	// Set shadow gender value
	$( "#gender_select .cir" ).click(function(){
		var gender_value = $(this).data('gender-val');
		var colours = fetchThemeColours();
		$( "#profile_gender" ).val(gender_value)
		$("#gender_select .cir").removeClass('theme-colour-main');
		$("#gender_select .cir").css({'backgroundColor': '#ccc'})
		$(this).addClass('theme-colour-main');
		setTheme()
	});

	// Set shadow colour value
	$( "#colour_select .cir" ).click(function(){
		var colour_value = $(this).data('colour-hex');
		$( "#profile_theme" ).val(colour_value);
		$("#colour_select .cir").removeClass('active')
		$(this).addClass('active');
	});

	/* ====================================
		Page Specific - Tracker  
	===================================== */ 

	$("#symptom-select .symptom-item").each(function( index, ele ) {
		var colours = fetchThemeColours();
		if ($(ele).data('state') == 1) { 
			$(ele).animate({'backgroundColor': colours.lighten}, 200)
		} else if ($(ele).data('state') == 2) { 
			$(ele).animate({'backgroundColor': colours.darkest}, 200)
		} else { 
			$(ele).animate({'backgroundColor': '#ccc'}, 200)
		} 
	});

	$('#symptom-select .symptom-item').click(function() { 
		var colours = fetchThemeColours();
		checkState(this, colours); 
	})

	function checkState(ele, colours){ 
		var state = 0;
		if ($(ele).data('state') == 0) { 
			state = 1;
			$(ele).animate({'backgroundColor': colours.lighten}, 200)
		} else if ($(ele).data('state') == 1) { 
			state = 2;
			$(ele).animate({'backgroundColor': colours.darkest}, 200)
		} else { 
			state = 0;
			$(ele).animate({'backgroundColor': '#ccc'}, 200)
		}
		$(ele).data('state', state); 
		$(ele).parent().find('input[type=hidden]').val(state);
	}

	$('.symptom-more-info').click(function(){ 
		var symptom_id = $(this).data('symptom-id');
		showPopup('symptomInfo.php', null, symptom_id);
	})

	$('.record-add-note').click(function(){ 
		var record_id = $(this).data('record-id');
		showPopup('addNote.php', record_id, record_id);
	})

	$("textarea").focus(function() {
		var colours = fetchThemeColours(); 
        $(this).css("borderColor", colours.main);
    });

	$('body').on('click', '.confirmNote', function() { 	
		var action = 'add_note';
		var record_id = $('#popup-inner').data('id'); 
		var note = $('#note-area').val();
		console.log(note);
		$.ajax({
			url : "app/controller/ajaxController.php", 
			data : { action: action, note: note, record_id: record_id},
			method : 'POST', 
			success : function(data){
				location.reload();
			}
		});
	}); 

	/* ====================================
		Page Specific - Tips  
	===================================== */

	$(".accordion .accord-header").click(function() {
	  $(".accordion .accord-header").removeClass('active');
      if($(this).next("div").is(":visible")){
        $(this).next("div").slideUp(200);
      } else {
        $(".accordion .accord-content").slideUp(200);
        $(this).next("div").slideToggle(200);
        $(this).addClass('active');
      }
    });

	/* ====================================
		Page Specific - Info
	===================================== */ 

	$('.tabbed .tab').click(function() { 
		$('.tab').removeClass('theme-colour-main');
		$('.tab').css({'backgroundColor': 'transparent'})
		$(this).addClass('theme-colour-main');

		var tab_name = $(this).data('tab');

		$('.tab-section').hide(); 
		$(".tab-section[data-section="+tab_name+"]").show();

		setTheme();  
	})

	/* ====================================
		Page Specific - Pre Login Particles
	===================================== */ 

	particlesJS.load('pre-login', 'assets/js/particles.json', function() {
  		console.log('callback - particles.js config loaded');
	});

	/* ====================================
		Init
	===================================== */ 

	setTheme();  

});