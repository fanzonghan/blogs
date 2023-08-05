<?php


namespace app\admin\middleware;

use app\model\SystemLog;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/5 14:40
 * @version 1.0
 */
class AdminLogMiddleware
{
    public function handle($request, \Closure $next)
    {
        $SystemLogModel = new SystemLog();
        $SystemLogModel->save([
            'page' => $request->url(),
            'type' => 1,
            'data' => json_encode($request->param(), JSON_UNESCAPED_UNICODE),
            'ip' => get_user_ip(),
            'add_time' => time()
        ]);
        return $next($request);
    }
}