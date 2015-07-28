<?php
require_once('downsample_image.php');

function watermark_image($image, $watermark, $marginTop = 0, $marginSide = 0) {
	// get the original dimensions
	$widthOrig = imagesx($image);
	$heightOrig = imagesy($image);
	$src_ratio = $src_w/$src_h;
	
	// scale the watermark to match the image
	$watermarkScaled = downsample_image($watermark, $widthOrig-(2*$marginSide), $heightOrig-(2*$marginTop));
	
	// get the dimensions of the watermark after scaling
	$watermarkWidth = imagesx($watermarkScaled);
	$watermarkHeight = imagesy($watermarkScaled);

	// create defensive copy of original image
	$imageFinal = imagecreatetruecolor($widthOrig, $heightOrig);
	imagecopy($imageFinal, $image, 0, 0, 0, 0, $widthOrig, $heightOrig);
	
	// compute location of watermark to make sure it is center
	$watermarkStartX = (($widthOrig-(2*marginSide)) - $watermarkWidth) / 2;
	$watermarkStartY = (($heightOrig-(2*marginTop)) - $watermarkHeight) / 2;
	
	// apply watermark
	imagecopy($imageFinal, $watermarkScaled, $watermarkStartX, $watermarkStartY, 0, 0, $watermarkWidth, $watermarkHeight);
	
	return $imageFinal;
}

