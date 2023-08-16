<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\model\User;
use app\Request;
use app\services\UserServices;
use think\App;
use think\facade\Validate;
use think\View;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/14 16:21
 * @version 1.0
 */
class UserController extends AdminController
{
    public $services;

    public function __construct(App $app, UserServices $userServices)
    {
        parent::__construct($app);
        $this->services = $userServices;
    }

    public function list(Request $request)
    {
        if ($request->isAjax()) {
            $page = $request->get('page', 1);
            $limit = $request->get('limit', 10);
            $list = $this->services->list([], $page, $limit);
            return json(['code' => 0, 'data' => $list, 'msg' => 'success']);
        }
        return $this->fetch('user/list');
    }

    public function add(Request $request)
    {
        if ($request->isPost()) {
            $post = $request->post();
            try {
                Validate([
                    'nickname|昵称' => 'require',
                    'acatar|头像' => 'require',
                    'account|账号' => 'require',
                    'password|密码' => 'require',
                    'phone|手机号' => 'require',
                ])->check($post);
                if (isset($post['upload-image'])) unset($post['upload-image']);
                $post['password'] = md5($post['password']);
            } catch (\Exception $e) {
                return json(['code' => 0, 'msg' => $e->getMessage()]);
            }
            $post['add_time'] = time();
            $post['add_ip'] = get_user_ip();
            $UserModel = new User();
            $res = $UserModel->insert($post);
            if ($res) {
                return json(['code' => 1, 'msg' => '添加成功']);
            } else {
                return json(['code' => 0, 'msg' => '添加失败']);
            }
        }
        return $this->fetch('user/add');
    }

    public function edit(Request $request)
    {
        if ($request->isPost()) {
            $post = $request->post();
            try {
                Validate([
                    'nickname|昵称' => 'require',
                    'acatar|头像' => 'require',
                    'account|账号' => 'require',
                    'phone|手机号' => 'require',
                ])->check($post);
                if (isset($post['upload-image'])) unset($post['upload-image']);
                if (empty($post['password'])) {
                    unset($post['password']);
                } else {
                    $post['password'] = md5($post['password']);
                }
            } catch (\Exception $e) {
                return json(['code' => 0, 'msg' => $e->getMessage()]);
            }
            $where = [];
            foreach ($post as $k => $v) {
                $where[$k] = $v;
            }
            $UserModel = new User();
            $res = $UserModel->update($where);
            if ($res) {
                return json(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json(['code' => 0, 'msg' => '修改失败']);
            }
        }
        $id = $request->get('id', 0);
        $info = $this->services->info($id);
        $info['last_time'] = date('Y-m-d H:i:s', $info['last_time']);
        $this->assign('info', $info);
        return $this->fetch('user/edit');
    }

    public function del(Request $request)
    {
        $id = $request->get('id', '');
        if (empty($id)) return json(['code' => 0, 'msg' => '用户不存在']);
        $UserModel = new User();
        $res = $UserModel->where('id', $id)->update(['is_del' => 1]);
        if ($res) {
            return json(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json(['code' => 0, 'msg' => '删除失败']);
        }
    }
}