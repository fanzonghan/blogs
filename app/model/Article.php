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

    //关联分类 一对一
    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    //关联文章详情
    public function articleDescription(){
        return $this->hasOne(ArticleDescription::class,'id','description');
    }

    //关联用户表
    public function user(){
        return $this->hasOne(User::class,'id','uid');
    }
}