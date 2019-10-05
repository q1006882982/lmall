<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/3
 * Time: 11:36
 */
namespace app\admin\controller;

use think\Request;
use think\Session;
use think\View;
use think\config;

class Base{
    protected $view = null;
    protected $request = null;

    public function __construct()
    {
        $this->view = View::instance(Config::get('template'), Config::get('view_replace_str'));
        $this->request = Request::instance();

        $not_check_controller_arr = [
            'app\admin\controller\Login'
        ];
        $class_name = get_class($this);
        if (!in_array($class_name, $not_check_controller_arr)){
            $this->check_login();
        }
    }

    public function assign($name, $value)
    {
        $this->view->assign($name, $value);
        return $this;
    }

    public function fetch($template = '', $vars = [], $replace = [], $config = [], $renderContent = false)
    {
        return $this->view->fetch($template, $vars, $replace, $config, $renderContent);
    }

    //验证登录
    public function check_login()
    {
        //if session[admin] 不存在, 返回 login/index
        $is_user = Session::get('admin');
        if (empty($is_user)){
            $this->redirect('admin/login/index');
        }
    }

    //redirect
    public function redirect($pathinfo_url)
    {
        header('Location:' . url($pathinfo_url));
    }

    //return ajax
    public function ajax_return($is, $msg='succ|err', $code=1)
    {
        $msg_arr = explode('|', $msg);
        $msg = $msg_arr[0];
        if (empty($is)){
            $code = 0;
            $msg = $msg_arr[1];
        }
        $data = [];
        $data['msg'] = $msg;
        $data['code'] = $code;
        echo json_encode($data);
    }

}