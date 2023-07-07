<?php


namespace app\model;

use xiaofan\basic\BaseModel;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/5 21:26
 * @version 1.0
 */
class Admin extends BaseModel
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
    protected $name = 'admin';
}