<?php
// Create and configure Slim app
$config = ['settings' => [
    'addContentLengthHeader' => false,
]];

//Add require for autoload
require '../vendor/autoload.php';

$app = new \Slim\App($config);

// Define app routes
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $response->write("Hello, " . $args['name']);
});

// Customer routes
require '../src/customers.php';


// Run app
$app->run();

?>