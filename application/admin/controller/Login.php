<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/3
 * Time: 17:24
 */
namespace app\admin\controller;

use think\Db;
use think\Session;

class Login extends Base {
    public function index()
    {
        if ($this->request->isPost()){
            $post = input('post.');
            $username = $post['username'];
            $password = $post['password'];
            $validate_code = $post['validate_code'];

            $user_info = Db::name('admin')
                ->where('name', $username)
                ->find();

//            if(!captcha_check($validate_code)){
//                $this->ajax_return(0, '|验证码错误');
//                return;
//            };
            if (empty($user_info)){
                $this->ajax_return(0, '|用户名不存在');
                return;
            }

            if ($user_info['password'] == $password){
                Session::set('admin', $user_info);
                $this->ajax_return(1);
            }else{
                $this->ajax_return(0, '|密码错误');
            }
            return;
        }
        return $this->view->fetch('public/login');
    }

    public function login_out()
    {
        Session::clear('lp');
    }
//    D:\phpstudy_pro\Extensions\tmp\tmp

}