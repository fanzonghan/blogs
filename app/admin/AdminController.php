<?php


namespace app\admin;

use think\App;
use think\facade\Cache;
use think\facade\Log;
use xiaofan\basic\BaseController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/5 1:51
 * @version 1.0
 */
class AdminController extends BaseController
{
    protected $adminInfo;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->app     = $app;
        $this->request = $this->app->request;
        // 控制器初始化
        $this->initialize();
    }


    // 初始化
    protected function initialize()
    {
        $gl_rule = [
            'login',
        ];
        if(!in_array($this->request->rule()->getRule(), $gl_rule)){
            if(empty(Cache::get('adminInfo'))){
                $this->error('未登录，请登陆',[],'/admin/login');
            }
            $this->adminInfo = Cache::get('adminInfo');
        }
    }
}