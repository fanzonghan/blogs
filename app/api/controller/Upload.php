<?php


namespace app\api\controller;

use app\services\upload\LocalUploadServices;
use app\services\upload\QiniuUploadServices;
use think\facade\Config;
use think\facade\Filesystem;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/8 2:05
 * @version 1.0
 */
class Upload
{
    private $type = 'qiniu';// local：本地 qiniu：七牛云

    public function uploads()
    {
        $files = request()->file('upload-image');
        try {
            /** @var LocalUploadServices $LocalUploadServices */
            $LocalUploadServices = app()->make(LocalUploadServices::class);
            /** @var QiniuUploadServices $QiniuUploadServices */
            $QiniuUploadServices = app()->make(QiniuUploadServices::class);
            switch ($this->type) {
                case 'qiniu':
                    $res = $QiniuUploadServices->uploadFile($files);
                    break;
                default:
                    $res = $LocalUploadServices->img($files);
                    break;
            }
            $data = [
                'url' => $res,
            ];
            return app('json')->success($data);
        } catch (\Exception $e) {
            return app('json')->fail($e->getMessage());
        }
    }

    public function video()
    {
        $files = request()->file('upload-video');
        try {
            /** @var LocalUploadServices $LocalUploadServices */
            $LocalUploadServices = app()->make(LocalUploadServices::class);
            /** @var QiniuUploadServices $QiniuUploadServices */
            $QiniuUploadServices = app()->make(QiniuUploadServices::class);
            switch ($this->type) {
                case 'qiniu':
                    $res = $QiniuUploadServices->uploadFile($files);
                    break;
                default:
                    $res = $LocalUploadServices->video($files);
                    break;
            }
            return app('json')->success($res);
        } catch (\Exception $e) {
            return app('json')->fail($e->getMessage());
        }
    }
}