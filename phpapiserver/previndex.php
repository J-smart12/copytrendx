<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'controller/index.php';

global $ctrlr;
$method = $_SERVER["REQUEST_METHOD"];
$url = parse_url($_SERVER['REQUEST_URI']);

// GET JSON Data
$json_data = json_decode(file_get_contents('php://input'), true);

$link = explode('/phpapiserver', $url['path']);

$url_link = rtrim($link[1], '/');

$path = ['/user/home', '/user', '/home', '/user/login', 'user/register'];

if(in_array($url_link, $path)) {
    $controller_ = explode('/', $url_link)[1];

    $Controller->setModel($controller_);

    $ctrlr = $Controller->getController();

    $ctl = $ctrlr->Login($json_data);

    echo json_encode([
        "success"=>true,
        "url"=>$url_link,
        "Controller"=>$ctl
    ]);
}else {
    echo json_encode([
        "success"=>false,
        "method"=>$method,
        "error"=>"404 page not found",
        "url"=>$url_link
    ]);
}

