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
        $list = $this->model->where('is_del', 0)->with(['category' => function ($query) {
            $query->visible(['name']);
        }, 'user'])->order('update_time desc')->where($where)->page($page, $limit)->select()->toArray();
        foreach ($list as &$item) {
            $item['add_time'] = date('Y-m-d H:i',$item['add_time']);
            $item['update_time'] = date('Y-m-d H:i',$item['update_time']);
        }
        $count = $this->model->where($where)->count();
        return ['list' => $list, 'total' => ceil($count / $limit)];
    }

    public function info($id): array
    {
        $info = $this->model->where('is_del', 0)->with([
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
            $info['add_time'] = date('Y-m-d H:i',$info['add_time']);
            $info['update_time'] = date('Y-m-d H:i',$info['update_time']);
            $info['tags'] = $TagModel->whereIn('id', $info['tag'])->field('name')->select()->toArray();
        } else {
            throw new Exception("文章不存在");
        }
        return $info;
    }

    //文章添加
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
                'add_time'=>time(),
                'update_time'=>time()
            ]);
            Db::commit();
            return $res;
        } catch (\Exception $e) {
            Db::rollback();
            Log::error($e->getLine());
            throw new ApiException("添加失败:" . $e->getMessage());
        }
    }

    //文章编辑
    public function edit($id, $data)
    {
        $ArticleDescription = new ArticleDescription();
        Db::startTrans();
        try {
            $articleInfo = $this->model->where('id', $id)->find();
            if (isset($data['desc'])) {
                $ArticleDescription->where('id', $articleInfo->description)->update([
                    'description' => $data['desc'],
                ]);
            }
            $sava = [];
            if (isset($data['title'])) $sava['title'] = $data['title'];
            if (isset($data['alias'])) $sava['alias'] = $data['alias'];
            if (isset($data['img'])) $sava['img'] = $data['img'];
            if (isset($data['category_id'])) $sava['category_id'] = $data['category_id'];
            if (isset($data['tags'])) $sava['tag'] = $data['tags'];
            if (isset($data['status'])) $sava['status'] = $data['status'] ?? 1;
            if (isset($data['is_del'])) $sava['is_del'] = $data['is_del'] ?? 0;
            $res = $articleInfo->save($sava);
            Db::commit();
            return $res;
        } catch (\Exception $e) {
            Db::rollback();
            throw new ApiException("修改失败:" . $e->getMessage());
        }
    }

    //删除
    public function del($id)
    {

    }
}