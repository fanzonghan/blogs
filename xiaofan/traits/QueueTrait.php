<?php

namespace xiaofan\traits;
use xiaofan\utils\Queue;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/6/3 1:23
 * @version 1.0
 */
trait QueueTrait
{
    /**
     * 列名
     * @return null
     */
    protected static function queueName()
    {
        return null;
    }

    /**
     * 加入队列
     * @param $action
     * @param array $data
     * @param string|null $queueName
     * @return mixed
     */
    public static function dispatch($action, array $data = [], string $queueName = null)
    {
        $queue = Queue::instance()->job(__CLASS__);
        if (is_array($action)) {
            $queue->data(...$action);
        } else if (is_string($action)) {
            $queue->do($action)->data(...$data);
        }
        if ($queueName) {
            $queue->setQueueName($queueName);
        } else if (static::queueName()) {
            $queue->setQueueName(static::queueName());
        }
        return $queue->push();
    }

    /**
     * 延迟加入消息队列
     * @param int $secs
     * @param $action
     * @param array $data
     * @param string|null $queueName
     * @return mixed
     */
    public static function dispatchSecs(int $secs, $action, array $data = [], string $queueName = null)
    {
        $queue = Queue::instance()->job(__CLASS__)->secs($secs);
        if (is_array($action)) {
            $queue->data(...$action);
        } else if (is_string($action)) {
            $queue->do($action)->data(...$data);
        }
        if ($queueName) {
            $queue->setQueueName($queueName);
        } else if (static::queueName()) {
            $queue->setQueueName(static::queueName());
        }
        return $queue->push();
    }
}