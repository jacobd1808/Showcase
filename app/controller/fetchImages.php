<?php 

	$id = $_GET['user_id'];

	$directory = $_SERVER["DOCUMENT_ROOT"]. "/stud/u1153568/final/showcase/assets/img/gallery_uploads/";
	$imageList = glob($directory . "*");
	$imageNameList = array(); 
	
	foreach($imageList as $image){
        $name = basename($image);
        if (strpos($name, $id) !== false) {
        	array_push($imageNameList, $name);
		}
    }

    echo json_encode($imageNameList);  
?> 