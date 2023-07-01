<?php


namespace app\model;

use xiaofan\basic\BaseModel;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/1 0:08
 * @version 1.0
 */
class Article extends BaseModel
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
    protected $name = 'article';

    public function category(){
        return $this->hasMany(Category::class,'id','category_id');
    }
}