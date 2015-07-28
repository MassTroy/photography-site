<?php
function load_image($filepath) { 
	$info = getimagesize($filepath);
	$imgtype = image_type_to_mime_type($info[2]);

	#assuming the mime type is correct
	switch ($imgtype) {
		case 'image/jpeg':
			$image = imagecreatefromjpeg($filepath);
			break;
		case 'image/gif':
			$image = imagecreatefromgif($filepath);
			break;
		case 'image/png':
			$image = imagecreatefrompng($filepath);
			break;
	}
	
	return $image;
}

