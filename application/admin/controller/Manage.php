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
//        $all_data = Db::name($this->main_table)
//            ->order('id', 'desc')
//            ->paginate(1, false, ['query'=>$this->request->get()]);
        $all_data = Db::name($this->main_table)
            ->order('id', 'desc')
            ->select();
        $this->assign('all_data', $all_data);
        return $this->fetch();
    }

    public function form()
    {
        $id = input('id/d');
        if (!empty($id)){
            $one_data = Db::name($this->main_table)->where('id', $id)->find();
            $this->assign('one_data', $one_data);
        }
        return $this->fetch();
    }

    public function save()
    {
        $data = input('post.');
        $id = (int)$data['id'];
        if ($id){
            //update
            $res = Db::name($this->main_table)->where('id', $id)->update($data);
        }else{
            //add
            $res = Db::name($this->main_table)->insertGetId($data);
        }
        $this->ajax_return($res);
        return;
    }

    public function del()
    {
        $id = input('id/d');
        if ($id){
            $res = Db::name($this->main_table)->where('id', $id)->delete();
            $this->ajax_return($res);
            return;
        }
    }
}