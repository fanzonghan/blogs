<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\services\BlogrollServices;
use think\App;
use think\Request;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/5 11:06
 * @version 1.0
 */
class BlogrollController extends AdminController
{
    public $services;

    public function __construct(App $app, BlogrollServices $services)
    {
        parent::__construct($app);
        $this->services = $services;
    }
    public function list(Request $request){
        if ($request->isAjax()) {
            $page = $request->get('page', 1);
            $limit = $request->get('limit', 10);
            $list = $this->services->getList([], $page, $limit);
            return json(['code' => 0, 'data' => $list, 'msg' => 'success']);
        }
        return $this->fetch('blogroll/list');
    }
}