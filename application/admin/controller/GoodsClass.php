<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/3
 * Time: 17:24
 */
namespace app\admin\controller;

use think\Db;

class GoodsClass extends Base {

    private $main_table = 'goods_class';

    public function index()
    {
        $all_data = Db::name($this->main_table)
            ->order('id', 'desc')
            ->select();
        $all_data = $this->tree($all_data);
//        dump($all_data);
        foreach ($all_data as $key=>$data) {
            //add 字段 xname
            //等级*4空格+
            $level = $data['level'];
            $tag = $level == 0 ? '' : '|_';
            $all_data[$key]['xname'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) . $tag . $data['name'];
        }



        $this->assign('all_data', $all_data);
        return $this->fetch();
    }

    public function tree($data, $pid=0, $level=0, $res=[])
    {
        foreach ($data as $k=>$v) {
            if ($v['pid'] == $pid){
                $v['level'] = $level;
                $res[] = $v;
                unset($data[$k]);
                $res = $this->tree($data, $v['id'], $level+1, $res);
            }
        }

        return $res;
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