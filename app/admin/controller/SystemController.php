<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\model\SystemConfig;
use app\model\SystemLog;
use DOMDocument;
use think\facade\Log;
use think\Model;
use think\Request;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/5 14:51
 * @version 1.0
 */
class SystemController extends AdminController
{
    //日志列表
    public function log_list(Request $request)
    {
        if ($request->isAjax()) {
            $SystemLog = new SystemLog();
            $page = $request->get('page', 1);
            $limit = $request->get('limit', 15);
            $keyword = $request->get('keyword', '');
            $type = $request->get('type', 2);
            //列表
            $list = $SystemLog->when(!empty($keyword), function ($query) use ($keyword) {
                $query->whereLike('id|page|ip', '%' . $keyword . '%');
            })->when($type != 2, function ($query) use ($type) {
                $query->where('type', $type);
            })->order('add_time desc')->page($page, $limit)->select();
            foreach ($list as &$item) {
                $item['add_time'] = date('Y-m-d H:i:s', $item['add_time']);
            }

            //总数
            $total = $SystemLog->when(!empty($keyword), function ($query) use ($keyword) {
                $query->whereLike('id|page|ip', '%' . $keyword . '%');
            })->when($type != 2, function ($query) use ($type) {
                $query->where('type', $type);
            })->count();
            return json(['code' => 0, 'data' => ['list' => $list, 'total' => $total], 'msg' => 'success']);
        }
        return $this->fetch('system/log/list');
    }

    //轮播图列表
    public function banner_list(Request $request)
    {
        if ($request->isAjax()) {
            $SystemConfigModel = new SystemConfig();
            $page = $request->get('page', 1);
            $limit = $request->get('limit', 15);
            $where = [
                'group' => 'banner'
            ];
            //列表
            $list = $SystemConfigModel->where($where)->order('add_time desc')->page($page, $limit)->select();
            foreach ($list as &$item) {
                $item['add_time'] = date('Y-m-d', $item['add_time']);
            }
            //总数
            $total = $SystemConfigModel->where($where)->count();
            return json(['code' => 0, 'data' => ['list' => $list, 'total' => $total], 'msg' => 'success']);
        }
        return $this->fetch('system/banner/list');
    }

    //轮播图添加
    public function banner_add(Request $request)
    {
        $data = $request->post();
        $SystemConfigModel = new SystemConfig();
        $res = $SystemConfigModel->save([
            'name' => $data['name'] ?? '',
            'group' => 'banner',
            'value' => $data['imgSrc'] ?? '',
            'remark' => $data['remark'] ?? '',
            'add_time' => time(),
            'update_time' => time()
        ]);
        if ($res) {
            return json(['code' => 1, 'msg' => '添加成功']);
        }
        return json(['code' => 0, 'msg' => '添加失败']);
    }

    //轮播图修改
    public function banner_edit(Request $request)
    {
        $data = $request->post();
        if (!isset($data['id'])) return json(['code' => 0, 'msg' => '参数异常']);
        $SystemConfigModel = new SystemConfig();
        $info = $SystemConfigModel->where('id', $data['id'])->find();
        if (!$info) return json(['code' => 0, 'msg' => '数据不存在']);
        $res = $info->save([
            'name' => $data['name'] ?? '',
            'remark' => $data['remark'] ?? '',
            'value' => $data['imgSrc'] ?? '',
            'update_time' => time()
        ]);
        if ($res) {
            return json(['code' => 1, 'msg' => '修改成功']);
        }
        return json(['code' => 0, 'msg' => '修改失败']);
    }
    //轮播图删除
    public function banner_del(Request $request)
    {
        $id = $request->get('id', '');
        if (empty($id)) return json(['code' => 0, 'msg' => '参数异常']);
        $SystemConfigModel = new SystemConfig();
        $res = $SystemConfigModel->where('id', $id)->delete();
        if ($res) {
            return json(['code' => 1, 'msg' => '删除成功']);
        }
        return json(['code' => 0, 'msg' => '删除失败']);
    }
}