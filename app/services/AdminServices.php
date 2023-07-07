<?php


namespace app\services;

use app\model\Admin;
use think\facade\Cache;
use xiaofan\basic\BaseServices;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/5 21:27
 * @version 1.0
 */
class AdminServices extends BaseServices
{
    public function __construct(Admin $admin)
    {
        $this->model = $admin;
    }
    public function login($username,$password){
        $userInfo = $this->model->where('account',$username)->where('is_del',0)->find();
        if($userInfo){
            if($userInfo['password'] == md5($password)){
                Cache::set('adminInfo', $userInfo);
                return '登录成功';
            }else{
                throw new \Exception("账号或密码错误");
            }
        }else{
            throw new \Exception("登陆账号不存在");
        }
    }
}