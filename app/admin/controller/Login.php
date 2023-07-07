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
class Login extends AdminController
{
    public function index(){
        return $this->fetch();
    }
    public function login(){
        if($this->request->isPost()){
            $username = $this->request->post('username','');
            $password = $this->request->post('password','');
            /** @var AdminServices $AdminServices */
            $AdminServices = app()->make(AdminServices::class);
            try {
                $this->success($AdminServices->login($username, $password));
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
        }
        $this->error('非法请求');
    }
}