<?php


namespace app\index\controller;

use app\services\ArticleServices;
use think\App;
use think\Exception;
use xiaofan\basic\BaseController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/6/16 23:21
 * @version 1.0
 */
class Category extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
    public function index(){
        /** @var ArticleServices $ArticleService */
        $ArticleService = app()->make(ArticleServices::class);
        $id = $this->request->param('id','');
        if(empty($id)) throw new Exception('分类不存在');
        $page = $this->request->param('page',1);
        $limit = $this->request->param('limit',10);

        $where = [
            ['status','=',1],
            ['category_id','=',$id],
        ];
        $res = $ArticleService->list($where,$page,$limit);
        $this->assign('article_list',$res['list']);
        $this->assign('total',$res['total']);
        $this->assign('page',$page);
        return $this->fetch();
    }
}