<?php

require_once 'traders.php';
require_once 'withdraws.php';
require_once 'deposit.php';
require_once 'settings.php';

$routes->get('/user/sitesettings', function($routes, $logic) {
    $settings = $logic->getSettings();
    echo json_encode($settings);
});

$routes->post('/user/sendEmail', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $register = $logic->sendEmailToClient($data);
    echo json_encode($register);
});

$routes->post('/user/sendCode', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $register = $logic->sendCode($data);
    echo json_encode($register);
});

$routes->post('/user/resetpassword', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $register = $logic->ChangePassword($data);
    echo json_encode($register);
});


$routes->post('/user/verifypin', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $pinverified = $logic->verifyPin($data);
    echo json_encode($pinverified);
});
$routes->post('/user/resendpin', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $pinsent = $logic->resendPin($data);
    echo json_encode($pinsent);
});

$routes->post('/user/me', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->getUser($data['user']);
    echo json_encode($user);
}); 


$routes->post('/user/miningplans', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->getMiningPlans();
    echo json_encode($user);
}); 

$routes->post('/user/plans', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->getPlans();
    echo json_encode($user);
});







$routes->post('/user/balances', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $bals = $logic->getAllbalances($data['user']);
    echo json_encode($bals);
});

$routes->post('/user/referers', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->getUserReferers($data['user']);
    echo json_encode($user);
});


$routes->post('/user/uploaddata', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->adds($data);
    echo json_encode($user);
});

$routes->post('/user/kyc', function($routes, $logic, $get, $post,$files) {
    $proof = $logic->uploadFile($files['image']);
    // var_dump(($proof));
    $data = [
        "user"=>$post['userid'],
        "kyc_number"=>$post['number'],
        "kyc_image"=>$proof['filename']
    ];
    
    $user = $logic->kyc($data);
    echo json_encode($user);
});

$routes->post('/user/newticket', function($routes, $logic, $get,$post,$files) {
    $proof = $logic->uploadFile($files['image']);
    
    $data = [
        "user"=>$post['userid'],
        "description"=>$post['message'],
        "title"=>$post['title'],
        "email"=>$post['email'],
        "image"=>$proof['filename'],
    ];
    
    $user = $logic->myticket($data);
    echo json_encode($user);
});

$routes->post('/user/settings', function($routes, $logic, $get,$post,$files) {
    $image = $logic->uploadFile($files['image']);
    
    $data = [
        "user"=>$post['userid'],
        "fullname"=>$post['fullname'],
        "email"=>$post['email'],
        "phone"=>$post['phone'],
        "gender"=>$post['gender'],
        "country"=>$post['country'],
        "dob"=>$post['dob'],
        "image"=>isset($image['filename'])?$image['filename']:'',
        "city"=>$post['city'],
        "password"=>$post['password'],
        "zip"=>$post['zip'],
        "address"=>$post['address']
    ];
    
    $user = $logic->UpdateUser($data);
    echo json_encode($user);
});

$routes->post('/user/walletexchange', function($routes, $logic, $get,$post,$files) {
    if($post['from_wallet'] == 'main') {
        $desc = "Main to Profit Wallet Exchanged";
        $trxx = "mtp";
    }else{
        $desc = "Profit to Main Wallet Exchanged";
        $trxx = "ptm";
    }
    
    $data = [
        "user"=>$post['userid'],
        "amount"=>$post['amount'],
        "description"=>$desc,
        "type"=>"Exchange",
        "gateway"=>"System",
        "fee"=>$post['fee'],
        "email"=>$post['email'],
        "re"=>$trxx
    ];
    
    $user = $logic->WalletExchange($data);
    echo json_encode($user);
});


$routes->post('/user/notifications', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $user = $logic->notifications($data['user']);
    echo json_encode($user);
});


$routes->post('/user/updates/password', function($routes, $logic) {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $update = $logic->updatePassword($data);
    echo json_encode($update);
});
