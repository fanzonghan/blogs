<?php


namespace app\services;

use app\model\Category;
use think\facade\Log;
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
        $list = $this->model->where('status',1)->where('pid',0)->order('sort desc')->field('id,name')->select()->toArray();
        foreach ($list as &$item){
            $item['z_cate'] = $this->model->where('status',1)->where('pid',$item['id'])->order('sort desc')->field('id,name')->select()->toArray();
        }
        return $list;
    }
    public function treeList($where){
        $page = $where['page'];
        $limit = $where['limit'];
        $list = $this->model->where('pid',0)->where('status',1)->order('create_time desc')->page($page,$limit)->select();
        $list = $this->treeDate($list);
        return $list;
    }

    public function treeDate($data){
        foreach ($data as &$item) {
            $item['children'] = $this->model->where('pid',$item['id'])->where('status',1)->order('create_time desc')->select();
        }
        return $data;
    }
}