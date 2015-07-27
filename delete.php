<?php 
	require("/includes/querys.php");
    require("/includes/resize.php"); 

	$image_id = $_GET["data_id"];

	$query_obj = new Querys;

	$query_obj->delele_image($image_id);
	//echo $image_id;
 ?>