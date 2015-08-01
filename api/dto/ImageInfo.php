<?php
require_once('dto/CameraInfo.php');
require_once('dto/ExposureSettings.php');

class ImageInfo {
	public $name;
	public $path;

	public $date;
	public $size;
	public $mimeType;
	public $height;
	public $width;

	public $camera;
	public $exposure;
	
	function __construct($name, $path) {
		$this->name = $name;
		$this->path = $path;

		$this->camera = new CameraInfo();
		$this->exposure = new ExposureSettings();
	}
}

