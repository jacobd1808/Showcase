<div class='modulated-box vert-center-popup' id='popup-content'> 
	<div id="avatarCrop"></div>
</div>

<script type='text/javascript'>

/* ==============================
  Avatar Uploader 
============================== */

var cropperOptions = {
  uploadUrl:'lib/croppic/img_save_to_file.php',
  cropUrl:'lib/croppic/img_crop_to_file.php',
  outputUrlId:'avatarUrl',
  rotateControls:false, 
  doubleZoomControls:true,
  loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
  modal: true,
  onAfterImgUpload:   function(){ 
  	var avatarURL = $('#avatarUrl').val();
  	var user_id = localStorage.getItem("userName") 
      $.ajax({
        method: 'POST', 
        url : "app/controller/ajaxController.php",
        dataType: "json",
        data : { action: 'editAvatarLink', user_id: user_id, avatarURL: avatarURL },
        success: function(data) {
          console.log(data);
        },
        error: function() { 
          displayOutcome('Something went wrong, please try again', 'error', 'outcomeMsgPicture');
        }
    });
  }
};
var cropperHeader = new Croppic('avatarCrop', cropperOptions);

</script>
