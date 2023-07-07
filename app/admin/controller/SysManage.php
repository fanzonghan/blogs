<?php


namespace app\admin\controller;

use app\admin\AdminController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/6 0:03
 * @version 1.0
 */
class SysManage extends AdminController
{
    public function config(){
        return $this->fetch();
    }
}