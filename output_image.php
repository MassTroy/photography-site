<?php
function output_image($image) {
	// TODO: detect content type
	header('Content-type: image/png');
	// TODO: add Content-length header
	
	imagepng($image);
	imagedestroy($image);
}

