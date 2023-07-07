<?php


namespace app\index\controller;

use app\services\ArticleServices;
use think\App;
use think\Exception;
use xiaofan\basic\BaseController;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/6/16 23:42
 * @version 1.0
 */
class Article extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    public function info(){
        /** @var ArticleServices $ArticleServices */
        $ArticleServices = app()->make(ArticleServices::class);
        $id = $this->request->param('id','');
        if(empty($id)) throw new Exception('文章不存在');
        $res = $ArticleServices->info($id);
        $relevant_list = [
            ['id'=>1,'title'=>'开源一款简单好看的记账系统，支持APP-微信小程序-H5'],
            ['id'=>2,'title'=>'PHP利用时间函数mktime获取多种时间戳的方式'],
            ['id'=>3,'title'=>'手把手教你用thinkphp+jwt做前后端分离'],
        ];
        $this->assign('article_data',$res);
        $this->assign('relevant_list',$relevant_list);
        return $this->fetch();
    }
}