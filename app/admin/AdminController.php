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
    }

    /**
     * @return mixed
     */
    public function getAdminInfo()
    {
        return $this->adminInfo;
    }

    /**
     * @param mixed $adminInfo
     */
    public function setAdminInfo($adminInfo): void
    {
        $this->adminInfo = $adminInfo;
    }

}