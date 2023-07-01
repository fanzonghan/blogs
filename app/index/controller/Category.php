<?php


namespace app\index\controller;

use think\App;
use xiaofan\basic\BaseController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/6/16 23:21
 * @version 1.0
 */
class Category extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
    public function index($id){
//        View::assign('id',$id);
        $this->title = 'aaa';
        return $this->fetch();
    }
}