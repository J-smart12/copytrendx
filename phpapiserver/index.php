<?php
header("Access-Control-Allow-Origin, *");
header('Content-Type: application/json; charset=utf-8');

require_once 'router/router.php';
require_once 'controller/index.php';

$routes = new ROUTES(); // This class needs to be globally auloaded 

require_once 'auth/auth.php'; // this class needs to be globally auloaded 

require_once 'users/routes/index.php'; // this class needs to be globally auloaded 

$routes->post('/404', function($routes){
    echo "Page not found";
});

// Initialize Routing 
$routes->openRoutes($Controller);


