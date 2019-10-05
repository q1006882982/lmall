<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/3
 * Time: 17:24
 */
namespace app\admin\controller;

class Index extends Base {
    public function index()
    {
        return $this->view->fetch('public/index');
    }

    public function welcome()
    {
        return $this->view->fetch('public/welcome');
    }
}