<?php
require_once 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

require_once 'settings.php';

////////////////////////////////////////////////////////////////////////////////
// imports
include_once('service/AlbumService.php');
include_once('service/ImageService.php');

////////////////////////////////////////////////////////////////////////////////
// API endpoints

$app = new \Slim\Slim();
// register root endpoint 
// TODO: add api documentation here
$app->get('/', function () {
    echo "Welcome to the API. Nothing to see here (yet...)";
});

// hello world
$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->get('/albums', function () use ($ALBUM_ROOT_DIRECTORY) {
	$service = new AlbumService();
    $albumList = $service->listAlbums($ALBUM_ROOT_DIRECTORY);
    print json_encode($albumList);
});

$app->get('/albums/:album/images', function ($album) use ($ALBUM_ROOT_DIRECTORY) {
	$service = new AlbumService();
    $imageList = $service->listImagesInAlbum($ALBUM_ROOT_DIRECTORY, $album);
    print json_encode($imageList);
});

$app->get('/albums/:album/images/:image', function ($album, $image) use ($ALBUM_ROOT_DIRECTORY) {
	$service = new ImageService();
	$imageInfo = $service->imageInfo($ALBUM_ROOT_DIRECTORY, $album, $image);
	print json_encode($imageInfo);
});

$response = $app->response();
$response->header("Content-Type", "application/json");
$app->run();

