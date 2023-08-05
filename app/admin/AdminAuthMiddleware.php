<?php


namespace app\admin;

use think\exception\HttpResponseException;
use think\facade\Cache;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/5 9:10
 * @version 1.0
 */
class AdminAuthMiddleware
{
    public function handle($request, \Closure $next)
    {
        /** @var AdminController $AdminController */
        $AdminController = app()->make(AdminController::class);
        $gl_rule = [
            'login',
        ];
        if(!in_array($request->rule()->getRule(), $gl_rule)){
            if(empty(Cache::get('adminInfo'))){
                $result = [
                    'code' => 0,
                    'msg'  => '未登录，请登陆',
                    'data' => [],
                    'url'  => '/admin/login',
                    'wait' => 3,
                ];
                $response = view(app()->getRootPath() . '/xiaofan/tpl/dispatch_jump.tpl', $result);
                throw new HttpResponseException($response);
            }
            $AdminController->setAdminInfo(Cache::get('adminInfo'));
        }
        return $next($request);
    }
}