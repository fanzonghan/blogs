<?php


namespace app\index\controller;

use app\services\ArticleServices;
use think\App;
use think\facade\View;
use think\Request;
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
    public function index($id){
        $Request = new Request();
        /** @var ArticleServices $ArticleServices */
        $ArticleServices = app()->make(ArticleServices::class);
        $list = $ArticleServices->list();
        $article_data = [
            'title'=>'开源一款简单好看的记账系统，支持APP-微信小程序-H5',
                'classify'=>'PHP',
            'author'=>'小范',
            'content'=>'<a>123121231546456</a>',
            'tag'=>[
                '标签一',
                '标签二',
                '标签三',
            ],
            'add_time'=>'2022-10-22 13:02:56',
            'browse_num'=>305,
        ];
        $relevant_list = [
            ['id'=>1,'title'=>'开源一款简单好看的记账系统，支持APP-微信小程序-H5'],
            ['id'=>2,'title'=>'PHP利用时间函数mktime获取多种时间戳的方式'],
            ['id'=>3,'title'=>'手把手教你用thinkphp+jwt做前后端分离'],
        ];
        $this->assign('article_data',$article_data);
        $this->assign('relevant_list',$relevant_list);
        return $this->fetch();
    }
}