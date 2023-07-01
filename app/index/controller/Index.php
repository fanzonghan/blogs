<?php


namespace app\index\controller;

use app\services\ArticleServices;
use app\services\BlogrollServices;
use think\App;
use think\facade\View;
use xiaofan\basic\BaseController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/6/16 21:33
 * @version 1.0
 */
class Index extends BaseController
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
        /** @var BlogrollServices $BlogrollServices */
        $BlogrollServices = app()->make(BlogrollServices::class);
        /** @var ArticleServices $ArticleService */
        $ArticleService = app()->make(ArticleServices::class);
        $this->assign('article_list',$ArticleService->index());
        $this->assign('blogroll',$BlogrollServices->list());//友情链接
        return $this->fetch();
    }

    /**
     * 搜索页
     * @return string
     * @throws \Exception
     */
    public function search(){
        return $this->fetch();
    }

}