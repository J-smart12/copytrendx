<?php

$routes->post('/user/login', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $login = $logic->Login($data);
    echo json_encode($login);
});

$routes->post('/user/logout', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $login = $logic->Logout($data);
    echo json_encode($login);
});

$routes->post('/user/register', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);    
    
    $register = $logic->Register($data);
    echo json_encode($register);
});