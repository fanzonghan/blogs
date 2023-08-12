<?php
declare (strict_types=1);

namespace app\admin\controller;

use app\admin\AdminController;
use app\model\Admin;
use app\model\Article;
use app\model\Feedback;
use app\model\SystemLog;
use think\facade\Cache;

class Index extends AdminController
{
    //首页
    public function index()
    {
        $this->assign('info', Cache::get('adminInfo'));
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
        $day_user_beg = $SystemLogModel->where('type', 0)->where('add_time', '>=', strtotime(date('Ymd', time())))->count();
        $day_user_num = $SystemLogModel->where('type', 0)->where('add_time', '>=', strtotime(date('Ymd', time())))->group('ip')->count();
        $this->assign(['articleTotal' => $articleTotal, 'feedbackTotal' => $feedbackTotal, 'day_user_beg' => $day_user_beg, 'day_user_num' => $day_user_num]);
        return $this->fetch();
    }

    //清除缓存
    public function clear()
    {

        $this->success('清除成功');
    }

    //管理员信息
    public function user()
    {
        $AdminModel = new Admin();
        $adminInfo = Cache::get('adminInfo');
        if ($this->request->isAjax()) {
            $param = $this->request->post();
            if (!isset($param['nickname']) || !isset($param['acatar']) || !isset($param['password']) || !isset($param['phone'])) {
                return json(['code' => 0, 'msg' => '参数异常']);
            }
            $where = [];
            if (!empty($param['nickname'])) {
                $where['nickname'] = $param['nickname'];
            }else{
                return json(['code' => 0, 'msg' => '昵称不能为空']);
            }
            if (!empty($param['acatar'])) {
                $where['acatar'] = $param['acatar'];
            }else{
                return json(['code' => 0, 'msg' => '头像不能为空']);
            }
            if (!empty($param['phone'])) {
                $where['phone'] = $param['phone'];
            }else{
                return json(['code' => 0, 'msg' => '手机号不能为空']);
            }
            if(!empty($param['password'])){
                $where['password'] = md5($param['password']);
            }
            $res = $AdminModel->where('id', $adminInfo['id'])->update($where);
            if ($res) {
                return json(['code' => 1, 'msg' => '修改成功']);
            } else {
                return json(['code' => 0, 'msg' => '修改失败']);
            }
        }
        $info = $AdminModel->where('id', $adminInfo['id'])->find();
        $info['last_time'] = date('Y-m-d H:i:s', $info['last_time']);
        $this->assign('info', $info);
        return $this->fetch();
    }
}
