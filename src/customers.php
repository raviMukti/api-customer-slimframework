<?php

$app = new \Slim\App($config);

// Define app routes
$app->get('/api/customers', function ($request, $response, $args) {
    return $response->withStatus(200)->write('Customers Works!');
});