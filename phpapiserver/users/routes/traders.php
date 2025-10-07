<?php
$routes->post('/user/allTraders', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $traders = $logic->allTraders($data['user']);
    echo json_encode($traders);
});

$routes->post('/user/copyTraders', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $traders = $logic->copyTraders($data);
    echo json_encode($traders);
});

$routes->post('/user/followTrader', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $traders = $logic->followTraders($data);
    echo json_encode($traders);
});

$routes->post('/user/trade', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $traders = $logic->trade($data);
    echo json_encode($traders);
});