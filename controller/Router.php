<?php
namespace CONTROLLER;

class Router {

    private $userModel;

    public function __construct() {
        $this->userModel = new \MODEL\User();
    }

    public function route($method, $get, $post) {
        if (!isset($get['action'])) {
            return array(
                'code'=>404,
                'error'=>'Specify correct action'
            );
        }

        if ($method == 'POST' && $get['action'] == 'auth') {
            $user = $this->userModel->login($post['login'], $post['password']);
            if (!$user) {
                return array(
                    'code'=>403,
                    'error'=>'Wrong login and/or password'
                );
            }
            return array(
                'code'=>200,
                'message'=>'Welcome',
                'user'=>$user
            );
        }
        /**
        elseif ($get['action'] == 'public action') {
            goes here
        }
        */

        $user = $this->userModel->checkToken($get['token']);
        if (!$user) {
            return array(
                'code'=>403,
                'error'=>'Authorization required'
            );
        }

        if ($method == 'DELETE' && $get['action'] == 'auth') {
            $this->userModel->logout($get['token']);
            return array(
                'code'=>200,
            );
        }
        if ($method == 'GET' && $get['action'] == 'users') {
            $page = isset($get['page']) ? $get['page'] : 1;
            $studentModel = new \MODEL\Student();
            $students = $studentModel->getList($page);
            return array(
                'code'=>200,
                'list'=>$students['list'],
                'pages'=>$students['pages']
            );
        }

        return array(
            'code'=>404,
            'error'=>'Specify correct action'
        );
    }

}