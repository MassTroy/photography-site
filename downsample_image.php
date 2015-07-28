<?php
function downsample_image($image, $width, $height) {
	// get the original dimensions
	$widthOrig = imagesx($image);
	$heightOrig = imagesy($image);
	$aspectRatio = $widthOrig/$heightOrig;

	// compute the new dimensions
	if ($width/$height > $aspectRatio) {
		// scale width to match height
		$width = $height*$aspectRatio;
	} else {
		// scale height to match width
		$height = $width/$aspectRatio;
	}

	// Resample
	$imageFinal = imagecreatetruecolor($width, $height);
	imagealphablending($imageFinal, false);
	imagesavealpha($imageFinal, true);
	imagecopyresampled($imageFinal, $image, 0, 0, 0, 0, $width, $height, $widthOrig, $heightOrig);
	
	return $imageFinal;
}

