<?php


namespace app\admin\controller;

use app\admin\AdminController;
use app\model\SystemConfig;
use app\Request;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/6 0:03
 * @version 1.0
 */
class SettingController extends AdminController
{
    public function config(Request $request){
        if($request->isAjax()){
            $post = $request->post();
            $post['status'] = isset($post['status'])? 1 : 0;
            $SystemConfig = new SystemConfig();
            foreach ($post as $k=>$item) {
                $SystemConfig->where('name',$k)->where('group','system')->update(['value'=>$item]);
            }
            return json(['code'=>0,'msg'=>'success']);
        }
        return $this->fetch('setting/config');
    }
}