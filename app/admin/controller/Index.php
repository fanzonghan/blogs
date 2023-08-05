<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\AdminController;

class Index extends AdminController
{
    public function index()
    {
        return $this->fetch();
    }
    public function home(){
        return $this->fetch();
    }
    public function clear(){
        $this->success('清除成功');
    }
}
