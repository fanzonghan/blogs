<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\model\Category;
use app\services\CategoryServices;
use think\Request;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/17 21:32
 * @version 1.0
 */
class CategoryController extends AdminController
{
    public function list(Request $request)
    {
        if ($request->isAjax()) {
            /** @var CategoryServices $CategoryServices */
            $CategoryServices = app()->make(CategoryServices::class);
            $where = [];
            $where['page'] = $request->get('page', 1);
            $where['limit'] = $request->get('limit', 10);
            $list = $CategoryServices->treeList($where);
            return json(['code' => 0, 'data' => $list, 'msg' => 'success']);
        }
        return $this->fetch('category/list');
    }

    public function add(Request $request)
    {
        $CategoryModel = new Category();
        $post = $request->post();
        $post['status'] = 1;
        $post['create_time'] = time();
        $post['update_time'] = time();
        $res = $CategoryModel->save($post);
        if ($res) {
            return json(['code' => 1, 'msg' => '添加成功']);
        } else {
            return json(['code' => 0, 'msg' => '添加失败']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->post('id', 0);
        $name = $request->post('name', '');
        $CategoryModel = new Category();
        $res = $CategoryModel->where('id', $id)->update(['name' => $name, 'update_time' => time()]);
        if ($res) {
            return json(['code' => 1, 'msg' => '修改成功']);
        } else {
            return json(['code' => 0, 'msg' => '修改失败']);
        }
    }

    public function del(Request $request)
    {
        $id = $request->get('id');
        if (empty($id)) return json(['code' => 0, 'msg' => 'ID不能为空']);
        $CategoryModel = new Category();
        $res = $CategoryModel->where('id', $id)->update(['status' => 0]);
        if ($res) {
            return json(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json(['code' => 0, 'msg' => '删除失败']);
        }
    }
}