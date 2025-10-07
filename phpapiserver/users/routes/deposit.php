<?php

$routes->post('/user/mydeposit', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->readSingle('deposits', 'id',$data['id']);
    echo json_encode($user);
});

$routes->post('/user/deposit', function($routes, $logic, $get,$post,$files) {
    $proof = $logic->uploadFile($files['image']);
    
    $data = [
        "user"=>$post['userid'],
        "amount"=>$post['amount'],
        "description"=>"Deposit With ".$post['name'],
        "type"=>"Deposit",
        "gateway"=>$post['symbol'], 
        "wallet"=>$post['wallet'],
        "fee"=>$post['fee']??0,
        "payproof"=>$proof['filename']
    ];
    
    $user = $logic->deposit($data);
    echo json_encode($user);
});

$routes->post('/user/deposit_bank', function($routes, $logic, $get,$post) {
    
    $data = [
        "user"=>$post['userid'],
        "amount"=>$post['amount'],
        "description"=>$post['description'],
        "type"=>$post['type'],
        "tid"=>$post['tid'],
        "accountName"=>$post['acctname'],
        "accountNumber"=>$post['acctnum'],
        "email"=>$post['email']
    ];
    
    $user = $logic->deposit_($data);
    echo json_encode($user);
});


$routes->post('/user/deposits', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->Alldeposits($data['user']);
    echo json_encode($user);
});

$routes->post('/user/transaction/single', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);

   
    
    $user = $logic->readSingle('transactions', 'id', $data['id']);
    echo json_encode($user);
});