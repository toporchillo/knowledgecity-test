<?php
include 'config.php';
include 'db/db.php';
include 'db/mysqli.php';
include 'model/User.php';
include 'model/Student.php';
include 'controller/Router.php';

try {
    $router = new \CONTROLLER\Router();

    $ret = $router->route($_SERVER['REQUEST_METHOD'], $_GET, $_POST);

}
catch (Exception $err) {
    $ret = array(
        'code'=>500,
        'error'=>$err->getMessage()
    );
}

header('Content-Type: application/json');
echo json_encode($ret);
