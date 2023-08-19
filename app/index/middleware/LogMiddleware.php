<?php


namespace app\index\middleware;

use app\model\SystemLog;
use cznet\IpLocation;
use think\facade\Log;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/5 14:40
 * @version 1.0
 */
class LogMiddleware
{
    public function handle($request, \Closure $next)
    {
        $SystemLogModel = new SystemLog();
        $IpLocation = new IpLocation();
        $location = $IpLocation->getlocation((string)get_user_ip());
        $SystemLogModel->save([
            'page' => $request->url(),
            'type' => 0,
            'data' => json_encode($request->param(), JSON_UNESCAPED_UNICODE),
            'ip' => get_user_ip(),
            'location' => $location['country'] . '(' . $location['area'] . ')',
            'add_time' => time()
        ]);
        return $next($request);
    }
}