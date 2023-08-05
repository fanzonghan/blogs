<?php


namespace app\services;

use app\model\Blogrool;
use xiaofan\basic\BaseServices;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/1 0:36
 * @version 1.0
 */
class BlogrollServices extends BaseServices
{
    public function __construct(Blogrool $blogrool)
    {
        $this->model = $blogrool;
    }

    public function list(){
        $list = $this->model->where('status',1)->select()->toArray();
        return $list;
    }
    public function getList($where = [],$page = 0,$limit = 0){
        $list = $this->model->when(!empty($where), function ($query)use($where){
            $query->where($where);
        })->page($page,$limit)->select();
        foreach ($list as &$item) {
            $item['add_time'] = date('Y-m-d H:i',$item['add_time']);
        }
        $count = $this->model->when(!empty($where), function ($query)use($where){
            $query->where($where);
        })->count();
        return ['list' => $list, 'total' => ceil($count / $limit)];
    }
}