<?php


namespace app\services;

use app\model\Category;
use xiaofan\basic\BaseServices;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/1 0:19
 * @version 1.0
 */
class CategoryServices extends BaseServices
{
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function list(){
        $list = $this->model->where('status',1)->where('pid',0)->order('sort desc')->field('id,name')->select();
        foreach ($list as &$item){
            $item['z_cate'] = $this->model->where('status',1)->where('pid',$item['id'])->order('sort desc')->field('id,name')->select();
        }
        return $list;
    }
}