<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/3
 * Time: 17:24
 */
namespace app\admin\controller;

use think\Db;

class Manage extends Base {

    private $main_table = 'admin';

    public function index()
    {
        $all_data = Db::name($this->main_table)
            ->order('id', 'desc')
            ->select();
        $this->assign('all_data', $all_data);
        return $this->fetch();
    }

    public function form()
    {
        return $this->fetch();
    }

    public function save()
    {

    }
}