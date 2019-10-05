<?php
namespace app\admin\controller;

/*
 * 模版替换字符串
 * 数据库
 * session前缀
 * */
class Test extends Base
{
    public function index()
    {
        return $this->view->fetch();
    }

    public function form()
    {
        return $this->view->fetch();
    }

    public function login()
    {
        return $this->view->fetch();
    }
}
