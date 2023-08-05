<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\model\SystemConfig;
use app\Request;
use think\Model;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/6 0:03
 * @version 1.0
 */
class SettingController extends AdminController
{
    public function config(Request $request)
    {
        if ($request->isAjax()) {
            $post = $request->post();
            try {
                switch ($post['type']) {
                    case 'basic':
                        $this->basic($post);
                        break;
                    case 'storage':
                        $this->storage($post);
                        break;
                    case 'music':
                        $this->music($post);
                        break;
                }
                return json(['code' => 1, 'msg' => '修改成功']);
            } catch (\Exception $e) {
                return json(['code' => 0, 'msg' => '修改失败：' . $e->getMessage()]);
            }
        }
        return $this->fetch('setting/config');
    }

    //基本配置修改
    public function basic($data)
    {
        $data['status'] = isset($data['status']) ? 1 : 0;
        $SystemConfig = new SystemConfig();
        foreach ($data as $k => $item) {
            $SystemConfig->where('name', $k)->where('group', 'system')->update(['value' => $item]);
        }
    }

    //存储配置修改
    public function storage($data)
    {
        $SystemConfig = new SystemConfig();
        //更新存储方式
        $SystemConfig->where('name', 'storage_type')->where('group', 'system')->update(['value' => $data['storage_type']]);
        //更新七牛云配置
        $SystemConfig->where('name', 'accessKey')->where('group', 'qiniu')->update(['value' => $data['accessKey']]);
        $SystemConfig->where('name', 'secretKey')->where('group', 'qiniu')->update(['value' => $data['secretKey']]);
        $SystemConfig->where('name', 'bucket')->where('group', 'qiniu')->update(['value' => $data['bucket']]);
        $SystemConfig->where('name', 'yzurl')->where('group', 'qiniu')->update(['value' => $data['yzurl']]);
    }

    //音乐配置修改
    public function music($data)
    {
        $SystemConfig = new SystemConfig();
        //更新七牛云配置
        $SystemConfig->where('name', 'name')->where('group', 'music')->update(['value' => $data['name']]);
        $SystemConfig->where('name', 'img')->where('group', 'music')->update(['value' => $data['img']]);
        $SystemConfig->where('name', 'url')->where('group', 'music')->update(['value' => $data['url']]);
    }
}