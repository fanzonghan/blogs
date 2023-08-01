<?php


namespace app\services\upload;

use think\facade\Config;
use think\facade\Filesystem;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/1 21:40
 * @version 1.0
 */
class LocalUploadServices
{
    /**
     * 图片
     * @param $files
     * @return string
     */
    public function img($files)
    {
        $savename = Filesystem::disk('public')->putFile('/img', $files);
        return sys_config('system_url') . Config::get('filesystem.disks.public.url') . DS . $savename;
    }

    /**
     * 视频
     * @param $files
     * @return string
     */
    public function video($files)
    {
        $savename = Filesystem::disk('public')->putFile('/video', $files);
        return sys_config('system_url') . Config::get('filesystem.disks.public.url') . DS . $savename;
    }
}