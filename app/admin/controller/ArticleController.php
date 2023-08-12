<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\model\Article;
use app\services\ArticleServices;
use app\services\CategoryServices;
use app\services\ExtendServices;
use app\services\TagServices;
use think\App;
use think\Exception;
use think\facade\Log;
use think\Request;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/6 1:26
 * @version 1.0
 */
class ArticleController extends AdminController
{
    private $services = ArticleServices::class;

    public function __construct(App $app, ArticleServices $articleServices)
    {
        parent::__construct($app);
        $this->services = $articleServices;
    }

    public function list(Request $request)
    {
        if ($request->isAjax()) {
            $page = $request->get('page', 1);
            $limit = $request->get('limit', 10);
            $list = $this->services->list([], $page, $limit);
            return json(['code' => 0, 'data' => $list, 'msg' => 'success']);
        }
        return $this->fetch('article/list');
    }

    public function add(Request $request)
    {
        if ($request->isPost()) {
            $post = $request->post();
//            $this->validate($post, [
//                'title' => 'required',
//                'alias' => 'required',
//                'tags' => 'required',
//                'category_id' => 'required|integer',
//                'img' => 'required',
//                'desc' => 'required',
//            ]);
            $res = $this->services->add($this->getAdminInfo()['uid'], $post);
            if ($res) {
                return json(['code' => 1, 'msg' => '添加成功']);
            } else {
                return json(['code' => 0, 'msg' => '添加失败']);
            }
        }
        /** @var TagServices $TagServices */
        $TagServices = app()->make(TagServices::class);
        /** @var CategoryServices $CategoryServices */
        $CategoryServices = app()->make(CategoryServices::class);
        $category = $CategoryServices->list();
        $this->assign('category', $category);
        $tags = $TagServices->list();
        $this->assign('tags', json_encode($tags, JSON_UNESCAPED_UNICODE));
        return $this->fetch('article/add');
    }

    public function edit(Request $request)
    {
        if ($request->isPost()) {
            $post = $request->post();
//            $this->validate($post, [
//                'title' => 'required',
//                'alias' => 'required',
//                'tags' => 'required',
//                'category_id' => 'required|integer',
//                'img' => 'required',
//                'desc' => 'required',
//            ]);
            $res = $this->services->edit($post['id'], $post);
            if ($res) {
                return json(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json(['code' => 0, 'msg' => '修改失败']);
            }
        }
        $id = $request->get('id', 0);
        $info = $this->services->info($id);
        $this->assign('info', $info);
//        $info['description'] = html_entity_decode($info['description']);
        Log::error($info['description']);
        $tags = explode(',', $info['tag']);
        $tags = array_map('intval', $tags);
        $this->assign('tags', json_encode($tags, JSON_UNESCAPED_UNICODE));
        /** @var TagServices $TagServices */
        $TagServices = app()->make(TagServices::class);
        /** @var CategoryServices $CategoryServices */
        $CategoryServices = app()->make(CategoryServices::class);
        $category = $CategoryServices->list();
        $this->assign('category', $category);
        $tagList = $TagServices->list();
        $this->assign('tagList', json_encode($tagList, JSON_UNESCAPED_UNICODE));
        return $this->fetch('article/edit');
    }

    public function del(Request $request)
    {
        $id = $request->get('id', '');
        if (empty($id)) return json(['code' => 0, 'msg' => '文章不存在']);
        $res = $this->services->edit($id, ['is_del' => 1, 'status' => -1]);
        if ($res) {
            return json(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json(['code' => 0, 'msg' => '删除失败']);
        }
    }

    /**
     * 收录
     * @param Request $request
     */
    public function gather(Request $request)
    {
        $id = $request->get('id', 0);
        if (empty($id)) return json(['code' => 0, 'msg' => '不能为空']);
        $info = Article::where('id', $id)->find();
        if (!$info) return json(['code' => 0, 'msg' => '文章不存在']);
        if ($info['sl']) return json(['code' => 0, 'msg' => '该文章已提交收录,不要重复提交哦']);
        /** @var ExtendServices $ExtendServices */
        $ExtendServices = app()->make(ExtendServices::class);
        $system_url = sys_config('system_url');
        $article_url = $system_url . '/' . 'article/' . $id;
        $res = $ExtendServices->BaiduRecord([$article_url]);
        if (isset($res['success']) && $res['success'] > 0) {
            //成功
            Article::where('id', $id)->update(['sl' => 1]);
            return json(['code' => 1, 'msg' => '提交成功']);
        } else {
            //失败
            return json(['code' => 0, 'msg' => $res['message'] ?? 'error']);
        }
    }
}