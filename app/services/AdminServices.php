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

    public function login($username, $password)
    {
        $userInfo = $this->model->where('account', $username)->where('is_del', 0)->find();

        if ($userInfo) {
            if ($userInfo['password'] == md5($password)) {
                // 更新最后登录时间和IP
                $this->model->where('id', $userInfo['id'])->update([
                    'last_time' => time(),
                    'last_ip' => get_user_ip(),
                ]);

                // 生成一个唯一的会话标识
                $sessionId = uniqid();

                // 仅存储需要的字段到 Redis 缓存
                $cachedData = [
                    'id' => $userInfo['id'],
                    'nickname' => $userInfo['nickname'],
                    'account' => $userInfo['account'],
                    'password' => $userInfo['password'],
                ];

                // 将会话标识与管理员信息关联并保存到缓存
                Cache::set('adminInfo:' . $sessionId, $cachedData, 3600 * 12); // 设置缓存有效期为12小时

                // 设置会话标识到用户浏览器的Cookie中
                cookie('adminSessionId', $sessionId, 3600 * 12); // 设置Cookie有效期为12小时

                return $userInfo; // 返回管理员信息
            } else {
                throw new \Exception("账号或密码错误");
            }
        } else {
            throw new \Exception("登陆账号不存在");
        }
    }
}