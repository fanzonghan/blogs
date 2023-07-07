<?php


namespace app\admin;

use think\App;
use think\facade\Cache;
use xiaofan\basic\BaseController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/5 1:51
 * @version 1.0
 */
class AdminController extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->app     = $app;
        $this->request = $this->app->request;
        $name = Request()->controller();
        $yz = [
            'Login'
        ];
        if(!in_array($name, $yz)){
            if($this->request->rootUrl()){
                if(empty(Cache::get('adminInfo'))){
                    $this->error("请登录后操作",[],'/admin/login');
                }
            }
        }
        // 控制器初始化
        $this->initialize();
    }


    // 初始化
    protected function initialize()
    {

    }
}