<?php


namespace app\api\controller;

use app\services\upload\LocalUploadServices;
use app\services\upload\QiniuUploadServices;
use think\facade\Config;
use think\facade\Filesystem;
use think\facade\Log;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/8 2:05
 * @version 1.0
 */
class Upload
{
    private $type = '';// local：本地 qiniu：七牛云
    public function __construct()
    {
        $this->type = sys_config('storage_type','local');
    }

    public function uploads()
    {
        $files = request()->file('upload-image');
        try {
            /** @var LocalUploadServices $LocalUploadServices */
            $LocalUploadServices = app()->make(LocalUploadServices::class);
            /** @var QiniuUploadServices $QiniuUploadServices */
            $QiniuUploadServices = app()->make(QiniuUploadServices::class);
            switch ($this->type) {
                case 'local':
                    $res = $LocalUploadServices->img($files);
                    $data = [
                        'url' => $res,
                    ];
                    break;
                case 'qiniu':
                    $res = $QiniuUploadServices->uploadFile($files);
                    $data = [
                        'url' => $res['file'],
                    ];
                    break;
                default:
                    throw new \Exception('未配置上传方式');
            }
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