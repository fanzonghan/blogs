<?php


namespace app\services;

use app\model\Article;
use app\model\Tag;
use think\Exception;
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
    public function list($where,$page,$limit){
        $list = $this->model->with(['category'=>function($query){
            $query->visible(['name']);
        },'articleDescription'=>function($query){
            $query->visible(['description']);
        }])->order('update_time desc')->where($where)->page($page,$limit)->select()->toArray();
        foreach ($list as &$item) {
            $item['create_time'] = date('Y-m-d H:i',$item['create_time']);
            $item['articleDescription']['description'] = substr(strip_tags($item['articleDescription']['description']),0,10);
        }

        $count = $this->model->with(['category'=>function($query){
            $query->visible(['name']);
        },'articleDescription'=>function($query){
            $query->visible(['description']);
        }])->order('update_time desc')->where($where)->count();
        return ['list'=>$list,'total'=>ceil($count / $limit)];
    }

    public function info($id): array
    {
        $info = $this->model->with([
            'category'=>function($query){
                $query->visible(['name']);
            },'articleDescription'=>function($query){
                $query->visible(['description']);
            },'user'=>function($query){
                $query->visible(['nickname']);
            }
        ])->order('update_time desc')->where('id',$id)->find()->toArray();
        $TagModel = new Tag();
        if($info){
            $info['create_time'] = date('Y-m-d H:i',$info['create_time']);
            $info['description'] = $info['articleDescription']['description'];
            $info['category'] = $info['category']['name'];
            $info['nickname'] = $info['user']['nickname'] ?? '';
            unset($info['articleDescription']);
            unset($info['user']);
            $info['tag'] = $TagModel->whereIn('id', $info['tag'])->field('name')->select()->toArray();
        }else{
            throw new Exception("文章不存在");
        }
        return $info;
    }
}