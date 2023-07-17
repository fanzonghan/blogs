<?php


namespace app\api\controller;

use think\facade\Config;
use think\facade\Filesystem;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/8 2:05
 * @version 1.0
 */
class upload
{
    public function uploads(){
        $files = request()->file('upload-image');
        try{
//            validate(['image'=>'fileSize:10240|fileExt:jpg|image:200,200,jpg'])
//                ->check($files);
            $savename = Filesystem::disk('public')->putFile('/img',$files);
            $res = [
                'url'=>sys_config('system_url') . Config::get('filesystem.disks.public.url') . DS . $savename,
            ];
            return app('json')->success($res);
        }catch (\Exception $e){
            return app('json')->fail($e->getMessage());
        }

    }
    public function video(){
        $files = request()->file('upload-video');
        try{
            $savename = Filesystem::disk('public')->putFile('/video',$files);
            $res = [
                'url'=>sys_config('system_url') . Config::get('filesystem.disks.public.url') . DS . $savename,
            ];
            return app('json')->success($res);
        }catch (\Exception $e){
            return app('json')->fail($e->getMessage());
        }
    }
}