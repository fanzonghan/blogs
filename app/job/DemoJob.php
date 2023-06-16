<?php


namespace app\job;

use xiaofan\basic\BaseJobs;
use xiaofan\traits\QueueTrait;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/6/3 1:26
 * @version 1.0
 */
class DemoJob extends BaseJobs
{
    use QueueTrait;
    public function doJob($data)
    {
        //使用
//        DemoJob::dispatch([$data]);
        return true;
    }
}