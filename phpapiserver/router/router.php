<?php
require_once 'controller/index.php';
class ROUTES {
    private $routes;
    private $Controller;

    public function openRoutes($controller) {
        $this->Controller = $controller;
        $uri = parse_url($_SERVER['REQUEST_URI']);

        // $method = $_SERVER['REQUEST_METHOD'];
        $uri = explode('/phpapiserver', $uri['path']);


        $url_link = rtrim($uri[1], '/');

        $found = false;

        // defining the controller
        $controller_ = explode('/', $url_link)[1];
        $this->Controller->setModel($controller_);
        $ctrlr = $this->Controller->getController();
        

        foreach($this->routes as $path => $callback) {
            if($path !== $url_link) continue;
            $found = true;
            call_user_func($callback, $this, $ctrlr, $_GET, $_POST, $_FILES);
        }

        if(!$found) {
            $notFoundCallback = $this->routes['/404'];
            call_user_func($notFoundCallback, $this);
        }
    }

    public function get(String $path, callable $callback) {
        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $this->routes[$path] = $callback;
        }
    }

    public function post(String $url, callable $callback) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->routes[$url] = $callback;
        }
    }
}