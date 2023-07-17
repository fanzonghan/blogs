<?php


namespace app\services;

use app\model\Article;
use app\model\ArticleDescription;
use app\model\Tag;
use think\Exception;
use think\facade\Db;
use think\facade\Log;
use xiaofan\basic\BaseServices;
use xiaofan\exceptions\ApiException;

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

    public function list($where, $page, $limit)
    {
        $list = $this->model->where('is_del',0)->with(['category' => function ($query) {
            $query->visible(['name']);
        }, 'articleDescription' => function ($query) {
            $query->visible(['description']);
        },'user'])->order('update_time desc')->where($where)->page($page, $limit)->select()->toArray();
        foreach ($list as &$item) {
            $item['description'] = mb_substr(strip_tags($item['articleDescription']['description']), 0, 50) . '...';
            unset($item['articleDescription']);
        }

        $count = $this->model->where($where)->count();
        return ['list' => $list, 'total' => ceil($count / $limit)];
    }

    public function info($id): array
    {
        $info = $this->model->where('is_del',0)->with([
            'category' => function ($query) {
                $query->visible(['name']);
            }, 'articleDescription' => function ($query) {
                $query->visible(['description']);
            }, 'user' => function ($query) {
                $query->visible(['nickname']);
            }
        ])->order('update_time desc')->where('id', $id)->find();
        $TagModel = new Tag();
        if ($info) {
            $info = $info->toArray();
            $info['description'] = $info['articleDescription']['description'];
            $info['category'] = $info['category']['name'];
            $info['nickname'] = $info['user']['nickname'] ?? '';
            unset($info['articleDescription']);
            unset($info['user']);
            $info['tags'] = $TagModel->whereIn('id', $info['tag'])->field('name')->select()->toArray();
        } else {
            throw new Exception("文章不存在");
        }
        return $info;
    }

    public function add($uid, $data)
    {
        $ArticleDescription = new ArticleDescription();
        Db::startTrans();
        try {
            $did = $ArticleDescription->create([
                'description' => $data['desc'],
            ]);
            $res = $this->model->save([
                'title' => $data['title'],
                'alias' => $data['alias'],
                'img' => $data['img'],
                'category_id' => $data['category_id'],
                'uid' => $uid,
                'description' => $did->id,
                'tag' => $data['tags'],
                'status' => 1,
            ]);
            Db::commit();
            return $res;
        } catch (\Exception $e) {
            Db::rollback();
            throw new ApiException("添加失败:" . $e->getMessage());
        }
    }
    public function edit($id, $data){
        $ArticleDescription = new ArticleDescription();
        Db::startTrans();
        try {
            $articleInfo = $this->model->where('id',$id)->find();
            $ArticleDescription->where('id',$articleInfo->description)->update([
                'description' => $data['desc'],
            ]);
            $res = $articleInfo->save([
                'title' => $data['title'],
                'alias' => $data['alias'],
                'img' => $data['img'],
                'category_id' => $data['category_id'],
                'tag' => $data['tags'],
                'status' => 1,
            ]);
            Db::commit();
            return $res;
        } catch (\Exception $e) {
            Db::rollback();
            throw new ApiException("修改失败:" . $e->getMessage());
        }
    }
}