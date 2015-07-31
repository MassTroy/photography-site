<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

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

$app->run();

