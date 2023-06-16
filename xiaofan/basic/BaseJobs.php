<?php


namespace xiaofan\basic;

use think\queue\Job;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/6/3 1:27
 * @version 1.0
 */
abstract class BaseJobs
{
    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        $this->fire(...$arguments);
    }

    /**
     * 运行消息队列
     * @param Job $job
     * @param $data
     */
    public function fire(Job $job, $data): void
    {
        try {
            $action     = $data['do'] ?? 'doJob';//任务名
            $infoData   = $data['data'] ?? [];//执行数据
            $errorCount = $data['errorCount'] ?? 0;//最大错误次数
            $this->runJob($action, $job, $infoData, $errorCount);
        } catch (\Throwable $e) {
            $job->delete();
        }
    }

    /**
     * 执行队列
     * @param string $action
     * @param Job $job
     * @param array $infoData
     * @param int $errorCount
     */
    protected function runJob(string $action, Job $job, array $infoData, int $errorCount = 3)
    {

        $action = method_exists($this, $action) ? $action : 'handle';
        if (!method_exists($this, $action)) {
            $job->delete();
        }

        if ($this->{$action}(...$infoData)) {
            //删除任务
            $job->delete();
        } else {
            if ($job->attempts() >= $errorCount && $errorCount) {
                //删除任务
                $job->delete();
            } else {
                //从新放入队列
                $job->release();
            }
        }

    }
}