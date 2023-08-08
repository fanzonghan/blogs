<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\AdminController;
use app\model\Article;
use app\model\Feedback;
use app\model\SystemLog;
use think\facade\Cache;

class Index extends AdminController
{
    //首页
    public function index()
    {
        $this->assign('info',Cache::get('adminInfo'));
        return $this->fetch();
    }
    //主页
    public function home()
    {
        $ArticleModel = new Article();
        $articleTotal = $ArticleModel->where('is_del', 0)->count();
        $FeedbackModel = new Feedback();
        $feedbackTotal = $FeedbackModel->where('status', 0)->count();
        $SystemLogModel = new SystemLog();
        $day_user_beg = $SystemLogModel->where('type', 0)->where('add_time', '>=', strtotime('Ymd'))->count();
        $day_user_num = $SystemLogModel->where('type', 0)->where('add_time', '>=', strtotime('Ymd'))->group('ip')->count();
        $this->assign(['articleTotal' => $articleTotal, 'feedbackTotal' => $feedbackTotal, 'day_user_beg' => $day_user_beg,'day_user_num'=>$day_user_num]);
        return $this->fetch();
    }
    //清除缓存
    public function clear()
    {

        $this->success('清除成功');
    }
    //管理员信息
    public function info(){
        return $this->fetch();
    }
}
