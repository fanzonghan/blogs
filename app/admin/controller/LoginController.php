<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\services\AdminServices;
use think\facade\Cache;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/5 2:01
 * @version 1.0
 */
class LoginController extends AdminController
{

    public function login()
    {
        if ($this->request->isPost()) {
            $username = $this->request->post('username', '');
            $password = $this->request->post('password', '');
            /** @var AdminServices $AdminServices */
            $AdminServices = app()->make(AdminServices::class);
            try {
                $res = $AdminServices->login($username, $password);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            if ($res) {
                $this->success('登陆成功', [], '/admin/index');
            } else {
                $this->error('登陆失败');
            }
        }
        return $this->fetch('login/index');
    }

    public function logout()
    {
        $sessionId = cookie('adminSessionId');
        Cache::delete('adminInfo:' . $sessionId); // 删除与该会话标识关联的管理员信息
        cookie('adminSessionId', null); // 清除Cookie

        $this->success('已退出，请重新登录', [], '/admin/login');
    }
}