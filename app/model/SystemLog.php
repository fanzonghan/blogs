<?php


namespace app\model;

use xiaofan\basic\BaseModel;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/5 14:06
 * @version 1.0
 */
class SystemLog extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'system_log';
}