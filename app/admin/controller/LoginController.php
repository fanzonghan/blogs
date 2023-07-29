<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\services\AdminServices;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/5 2:01
 * @version 1.0
 */
class LoginController extends AdminController
{
    public function index()
    {
        return $this->fetch('login/index');
    }

    public function login()
    {
        $username = $this->request->post('username', '');
        $password = $this->request->post('password', '');
        /** @var AdminServices $AdminServices */
        $AdminServices = app()->make(AdminServices::class);
        try {
            if ($AdminServices->login($username, $password)) {
                $this->success('登陆成功', '', '/admin/index');
            } else {
                $this->error('登陆失败');
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}