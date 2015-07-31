<?php
require_once('dto/Album.php');

class AlbumService {

	public function listAlbums($albumRootDirectory) {
		$albumList = array();
	
		for ($i = 1; $i <= 7; $i++) {
			$name = "PhotoAlbum" . $i;
			$album = new Album($name, "some/path", "2015-07-30");
			array_push($albumList, $album);
		}
	
		return $albumList;
	}
	
}
