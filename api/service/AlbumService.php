<?php
require_once('dto/Album.php');

class AlbumService {

	public function listAlbums($albumRootDirectory) {
		$files = scandir($albumRootDirectory, SCANDIR_SORT_ASCENDING);
		
		$albumList = array();
		foreach ($files as $file) {
			$path = rtrim($albumRootDirectory, '/') . "/" . $file;
			if (is_dir($path) && $file != "." && $file != "..") {
				$album = new Album($file, $path, null);
				array_push($albumList, $album);
			}
		}
	
		return $albumList;
	}
	
}
