<?php


namespace app\admin\controller;

use app\admin\AdminController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/6 1:26
 * @version 1.0
 */
class Article extends AdminController
{
    public function list(){
        if($this->request->isAjax()){
            return json(['code'=>0,'data'=>[['id'=>1]]]);
        }
        return $this->fetch();
    }
    public function add(){
        return $this->fetch();
    }
}