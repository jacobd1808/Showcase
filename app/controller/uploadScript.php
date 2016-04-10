<?php

	$newFileName = $_POST['fileName'] .'_'. rand(1,1000) .'_'. time(); 

    $imagePath = $_SERVER["DOCUMENT_ROOT"]. "Showcase/assets/img/gallery_uploads/";

	$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp); 
	
	//Check write Access to Directory
	
	if ( in_array($extension, $allowedExts))
	  {
	  if ($_FILES["file"]["error"] > 0)
		{
			$response = array(
				"status" => 'error',
				"message" => 'ERROR Return Code: '. $_FILES["file"]["error"],
			);			
		} else {
			
	      $filename = $_FILES["file"]["tmp_name"];
		  
		  list($width, $height) = getimagesize( $filename );
		  
		  move_uploaded_file($filename, $imagePath . $newFileName .'.'. $extension);

		  $response = array(
			"status" => 'success',
			"url" => '../upload/' . $_FILES["file"]["name"],
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
