<?php


namespace app\index\controller;

use app\index\IndexController;
use think\App;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/4 1:38
 * @version 1.0
 */
class Feedback extends IndexController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * 首页
     * @return string
     * @throws \Exception
     */
    public function index(){
        return $this->fetch();
    }
}