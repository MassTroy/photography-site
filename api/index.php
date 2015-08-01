<?php
require_once 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

////////////////////////////////////////////////////////////////////////////////
// imports
include_once('service/AlbumService.php');


////////////////////////////////////////////////////////////////////////////////
// settings
// TODO: move settings to a different file

$ALBUM_ROOT_DIRECTORY = "../albums";

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

$response = $app->response();
$response->header("Content-Type", "application/json");
$app->run();

