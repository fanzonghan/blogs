<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\model\Blogroll;
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

    public function list(Request $request)
    {
        if ($request->isAjax()) {
            $page = $request->get('page', 1);
            $limit = $request->get('limit', 10);
            $list = $this->services->getList([], $page, $limit);
            return json(['code' => 0, 'data' => $list, 'msg' => 'success']);
        }
        return $this->fetch('blogroll/list');
    }

    public function add(Request $request)
    {
        $data = $request->post();
        $BlogrollModel = new Blogroll();
        $res = $BlogrollModel->save([
            'name' => $data['name'] ?? '',
            'url' => $data['url'] ?? '',
            'status' => 1,
            'add_time' => time(),
        ]);
        if ($res) {
            return json(['code' => 1, 'msg' => '添加成功']);
        }
        return json(['code' => 0, 'msg' => '添加失败']);
    }

    public function edit(Request $request)
    {
        $data = $request->post();
        $BlogrollModel = new Blogroll();
        if (!isset($data['id'])) return json(['code' => 0, 'msg' => '参数异常']);
        $info = $BlogrollModel->where('id', $data['id'])->find();
        if (!$info) return json(['code' => 0, 'msg' => '数据不存在']);
        $res = $info->save([
            'name' => $data['name'] ?? '',
            'url' => $data['url'] ?? '',
            'status' => 1,
        ]);
        if ($res) {
            return json(['code' => 1, 'msg' => '修改成功']);
        }
        return json(['code' => 0, 'msg' => '修改失败']);
    }

    public function del(Request $request)
    {
        $id = $request->get('id', 0);
        if (empty($id)) return json(['code' => 0, 'msg' => '参数异常']);
        $BlogrollModel = new Blogroll();
        $info = $BlogrollModel->where('id', $id)->find();
        if (!$info) return json(['code' => 0, 'msg' => '数据不存在']);
        $res = $info->save([
            'status' => 0,
        ]);
        if ($res) {
            return json(['code' => 1, 'msg' => '删除成功']);
        }
        return json(['code' => 0, 'msg' => '删除失败']);
    }
}