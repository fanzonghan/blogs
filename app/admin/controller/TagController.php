<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\model\Tag;
use app\Request;
use app\services\TagServices;
use think\App;
use think\facade\View;
use think\Model;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/16 19:19
 * @version 1.0
 */
class TagController extends AdminController
{
    public $services;

    public function __construct(App $app, TagServices $tagServices)
    {
        parent::__construct($app);
        $this->services = $tagServices;
    }

    public function list(Request $request)
    {
        if ($request->isAjax()) {
            $page = $request->get('page', 1);
            $limit = $request->get('limit', 10);
            $list = $this->services->getList([], $page, $limit);
            return json(['code' => 0, 'data' => $list, 'msg' => 'success']);
        }
        return $this->fetch('tag/list');
    }

    public function edit(Request $request)
    {
        $post = $request->post();
        $tagModel = new Tag();
        $res = $tagModel->where('id', $post['id'])->update(['name' => $post['name']]);
        if ($res) {
            return json(['code' => 1, 'msg' => '修改成功']);
        } else {
            return json(['code' => 0, 'msg' => '修改失败']);
        }
    }

    public function add(Request $request)
    {
        $post = $request->post();
        $tagModel = new Tag();
        $res = $tagModel->save([
            'name' => $post['name'],
            'add_time' => time()
        ]);
        if ($res) {
            return json(['code' => 1, 'msg' => '添加成功']);
        } else {
            return json(['code' => 0, 'msg' => '添加失败']);
        }
    }

    public function del(Request $request)
    {
        $id = $request->get('id');
        if (empty($id)) return json(['code' => 0, 'msg' => 'ID不能为空']);
        $tagModel = new Tag();
        $res = $tagModel->where('id', $id)->update(['is_del' => 1]);
        if ($res) {
            return json(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json(['code' => 0, 'msg' => '删除失败']);
        }
    }
}