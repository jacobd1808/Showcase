<?php
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
    //$imagePath = __DIR__ . "/../../upload/";
	$imagePath = $_SERVER["DOCUMENT_ROOT"] . "Showcase/assets/img/avatars/";

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["img"]["name"]);
	$extension = end($temp);
	
	//Check write Access to Directory
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["img"]["error"] > 0)
		{
			 $response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
			);			
		}
	  else
		{
			
	      $filename = $_FILES["img"]["tmp_name"];
		  list($width, $height) = getimagesize( $filename );

		  
		  //move_uploaded_file($_FILES['avatar-file']['tmp_name'],"uploads/avatars/".$_FILES['avatar-file']['name']);
		  move_uploaded_file($filename, $imagePath . $_FILES["img"]["name"]);

		  $response = array(
			"status" => 'success',
			"url" => 'assets/img/avatars/' . $_FILES["img"]["name"],
			"width" => $width,
			"height" => $height
		  );
		  
		}
	  }
	else
	  {
	   $response = array(
			"status" => 'error',
			"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
		);
	  }
	  
	  print json_encode($response);

?>
