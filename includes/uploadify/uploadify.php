<?php
require("../querys.php");
require("../resize.php");
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$query_obj = new Querys;
$targetFolder = '/images/gallery/'; // Relative to the root
$dateTime = date('Y/m/d h:i:s');

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];

	// Folder gallery path
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);

	$image_ext = $fileParts['extension']; // Getting the image extention
	$image_name = basename( $_FILES['Filedata']['name']); // Getting the image name
	
	// Generating a unique image path
	$image_path = md5(rand() * time()).md5($image_name).".".$image_ext;

	// Generating a unique thumb image path
	$thumb_image_path = "thumb_".$image_path;

	// Complete image path
	$targetFile = rtrim($targetPath,'/') . '/' . $image_path;
	// Complete thumb image path
	$thumbTargetFile = rtrim($targetPath,'/') . '/' . $thumb_image_path;

	$complete_image_path = $targetFolder.$image_path;
	$complete_thumb_path = $targetFolder.$thumb_image_path;

	
	if (in_array($image_ext,$fileTypes)) {
		copy($tempFile,$targetFile);
		//move_uploaded_file($tempFile,$targetFile);
		$thumb = new thumbnail($targetFile);
	    $thumb->size_width(400);
	    $thumb->size_height(300);
	    $thumb->jpeg_quality(100);
	    $thumb->save($thumbTargetFile);
		
		$query_obj->add_image($complete_thumb_path, $complete_image_path, "", 1, $dateTime, 1, $dateTime);
		
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>