<?php


namespace app\index;

use think\App;
use xiaofan\basic\BaseController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/15 17:48
 * @version 1.0
 */
class IndexController extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
        $status = sys_config('status', '', 1);
        if (!$status) {
            $this->error('站点升级中.....', [], '#');
        }
        if (request()->isOptions()) {
            exit;
        }
    }
}