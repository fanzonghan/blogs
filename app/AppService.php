<?php
declare (strict_types = 1);

namespace app;

use think\Service;
use xiaofan\utils\Json;

/**
 * 应用服务类
 */
class AppService extends Service
{
    public function register()
    {
        // 服务注册
//        $this->commands([
//            'build' => command\Build::class,
//        ]);

        $this->app->bind([
            'json' => Json::class,
        ]);
    }

    public function boot()
    {
        // 服务启动
    }
}
