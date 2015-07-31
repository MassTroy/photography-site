<?php
require_once 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

////////////////////////////////////////////////////////////////////////////////
// imports
include_once('service/AlbumService.php');

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

// hello world
$app->get('/albums', function () {
	$service = new AlbumService();
    $albumList = $service->listAlbums('../albums/');
    print json_encode($albumList);
});

$response = $app->response();
$response->header("Content-Type", "application/json");
$app->run();

