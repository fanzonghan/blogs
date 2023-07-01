<?php


namespace app\services;

use app\model\Article;
use xiaofan\basic\BaseServices;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/1 0:18
 * @version 1.0
 */
class ArticleServices extends BaseServices
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }
    public function index(){
        $where = [
            ['status','=',1]
        ];
        $list = $this->model->with('category')->where($where)->select()->toArray();
        foreach ($list as &$item) {
            $item['create_time'] = date('Y-m-d H:i',$item['create_time']);
        }
        print_r($list);
        return $list;
    }
    public function list($data,$page,$limit){
        $where = [
            ''
        ];
        $list = $this->model->where($where)->page($page,$limit)->select()->toArray();
        return $list;
    }
}