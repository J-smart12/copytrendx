<?php
require_once 'database/dbconfig.php';
require_once 'controller/user.php';

class Controller {
    private $model;
    private $dbinstance;

    function __construct($dbg)
    {
        $this->dbinstance = $dbg;
    }

    public function setModel($model) {
        $this->model = $model;
    }

    public function getController() {
        if($this->model == "user") {
            $model = new User($this->dbinstance);
        }else {
            $model = null;
        }

        return $model;
    }
}

$Controller = new Controller($db);
