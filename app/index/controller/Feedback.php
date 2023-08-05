<?php


namespace app\index\controller;

use app\index\IndexController;
use think\App;
use think\facade\Cache;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/4 1:38
 * @version 1.0
 */
class Feedback extends IndexController
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
    public function index()
    {
        $FeedbackModel = new \app\model\Feedback();
        $page = $this->request->get('page', 1);
        $limit = $this->request->get('limit', 10);
        $list = $FeedbackModel->where(['aid' => 0, 'status' => 0])->order('add_time desc')->page($page, $limit)->select()->toArray();
        foreach ($list as &$item) {
            $item['add_time'] = date('Y-m-d H:i', $item['add_time']);
            $item['reply'] = json_decode($item['reply'], true) ?? [];
        }
        $total = $FeedbackModel->where(['aid' => 0, 'status' => 0])->count();
        $this->assign('total', $total);
        $this->assign('page', $page);
        $this->assign('pages', ceil($total / $limit));
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        $FeedbackModel = new \app\model\Feedback();
        $post = $this->request->post();
        if (Cache::get('verifyCode') != ($post['verify'] ?? '')) {
            return json(['code' => 0, 'msg' => '验证码不正确']);
        }
        if (empty($post['id'])) {
            //留言
            $res = $FeedbackModel->save([
                'aid' => $post['aid'] ?? 0,
                'nickname' => $post['nickname'] ?? '',
                'contact' => $post['contact'] ?? '',
                'details' => $post['details'] ?? '',
                'reply' => '',
                'ip' => get_user_ip(),
                'add_time' => time(),
            ]);
            if (!$res) return json(['code' => 0, 'msg' => '留言失败']);
            return json(['code' => 1, 'msg' => '留言成功']);
        } else {
            //评论
            $res = $FeedbackModel->where('id', $post['id'])->find();
            if (!$res) return json(['code' => 0, 'msg' => '评论失败']);
            $reply = json_decode($res['reply'], true) ?? [];
            array_push($reply, [
                'nickname' => $post['nickname'] ?? '',
                'contact' => $post['contact'] ?? '',
                'details' => $post['details'] ?? '',
                'ip' => get_user_ip(),
                'add_time' => time(),
            ]);
            $reply = json_encode($reply, 256);
            $res = $FeedbackModel->where('id', $post['id'])->update(['reply' => $reply]);
            if (!$res) return json(['code' => 0, 'msg' => '评论失败']);
            return json(['code' => 1, 'msg' => '评论成功']);
        }
    }
}