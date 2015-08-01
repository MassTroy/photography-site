<?php
require_once('dto/ImageInfo.php');
require_once('util/FilePathUtils.php');

class ImageService {

	public function imageInfo($albumRootDirectory, $album, $image) {
		$imagePath = sandbox_relative_path(
			sandbox_relative_path($albumRootDirectory, $album), $image);

		// read metadata tags
		$tags = exif_read_data($imagePath);
		//var_dump($tags);

		// build image info object
		$imageInfo = new ImageInfo($image, $imagePath);

		// extract all usefull tags
		$imageInfo->date = $tags['DateTimeOriginal'];
		$imageInfo->size = $tags['FileSize'];
		$imageInfo->mimeType = $tags['MimeType'];
		$imageInfo->height = $tags['COMPUTED']['Height'];
		$imageInfo->width = $tags['COMPUTED']['Width'];
		
		$imageInfo->camera->cameraMake = $tags['Make'];
		$imageInfo->camera->cameraModel = $tags['Model'];
		$imageInfo->camera->lens = $this->parseLens($tags);
		$imageInfo->camera->ccdWidth = $tags['COMPUTED']['CCDWidth'];

		$imageInfo->exposure->exposureTime = $tags['ExposureTime'];
		$imageInfo->exposure->aperatureFNumber = $tags['COMPUTED']['ApertureFNumber'];
		$imageInfo->exposure->isoSpeed = $tags['ISOSpeedRatings'];
		$imageInfo->exposure->focalLength = $this->parseFocalLength($tags);

		return $imageInfo;
	}

	private function parseFocalLength($tags) {
		$focalLength = $tags['FocalLength'];
		return explode('/', $focalLength)[0] . "mm";
	}

	private function parseLens($tags) {
		$lens = $tags['UndefinedTag:0xA434']; // 'UndefinedTag:0xA434' 'UndefinedTag:0x0095'
		return $lens;
	}
	
}
