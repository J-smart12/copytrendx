<?php


$routes->post('/user/withdraw', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->withdraw($data);
    echo json_encode($user);
}); 

$routes->post('/user/withdraw_cot_code', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->withdraw_cot_code($data);
    echo json_encode($user);
});

$routes->post('/user/withdraw_imf_code', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->withdraw_imf_code($data);
    echo json_encode($user);
});

$routes->post('/user/withdraw_har_code', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->withdraw_har_code($data);
    echo json_encode($user);
});

$routes->post('/user/withdraw_tax_code', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->withdraw_tax_code($data);
    echo json_encode($user);
});


$routes->post('/user/withdraws', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->Allwithdraws($data['user']);
    echo json_encode($user);
});
