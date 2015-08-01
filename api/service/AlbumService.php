<?php
require_once('dto/Album.php');
require_once('dto/ImageListing.php');
require_once('util/FilePathUtils.php');

class AlbumService {

	public function listAlbums($albumRootDirectory) {
		$files = scandir($albumRootDirectory, SCANDIR_SORT_ASCENDING);
		
		$albumList = array();
		foreach ($files as $file) {
			$path = path_append($albumRootDirectory, $file);
			if (is_dir($path) && $file != "." && $file != "..") {
				$album = new Album($file, $path, null);
				array_push($albumList, $album);
			}
		}
	
		return $albumList;
	}

	public function listImagesInAlbum($albumRootDirectory, $album) {
		$albumPath = sandbox_relative_path($albumRootDirectory, $album);
		$files = scandir($albumPath, SCANDIR_SORT_ASCENDING);
		
		$imageList = array();
		foreach ($files as $file) {
			$path = path_append($albumPath, $file);
			if (is_file($path)) {
				$imageListing = new ImageListing($file, $path);
				array_push($imageList, $imageListing);
			}
		}
	
		return $imageList;
	}
	
}
