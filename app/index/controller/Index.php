<?php


namespace app\index\controller;

use app\index\IndexController;
use app\model\SystemConfig;
use app\services\ArticleServices;
use think\App;
use think\Exception;
use think\Model;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/6/16 21:33
 * @version 1.0
 */
class Index extends IndexController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    /**
     * 首页
     * @return string
     * @throws \Exception
     */
    public function index(){
        /** @var ArticleServices $ArticleService */
        $ArticleService = app()->make(ArticleServices::class);
        $page = $this->request->param('page',1);
        $limit = $this->request->param('limit',10);
        $where = [
            ['status','=',1]
        ];
        $res = $ArticleService->list($where,$page,$limit);
        $this->assign('article_list',$res['list']);
        $this->assign('total',$res['total']);
        $this->assign('page',$page);
        $SystemConfig = new SystemConfig();
        $bannerArr = $SystemConfig->field('name,value as src')->where('group','banner')->select();
        $this->assign('bannerList',$bannerArr);
        return $this->fetch();
    }

    /**
     * 搜索页
     * @return string
     * @throws \Exception
     */
    public function search(){
        /** @var ArticleServices $ArticleService */
        $ArticleService = app()->make(ArticleServices::class);
        $keyword = $this->request->param('keyword','');
        if(empty($keyword)) throw new Exception('不能为空');
        $page = $this->request->param('page',1);
        $limit = $this->request->param('limit',10);
        $where = [
            ['status','=',1],
            ['title','like','%'. $keyword .'%']
        ];
        $res = $ArticleService->list($where,$page,$limit);
        $this->assign('article_list',$res['list']);
        $this->assign('total',$res['total']);
        $this->assign('page',$page);
        return $this->fetch();
    }

}