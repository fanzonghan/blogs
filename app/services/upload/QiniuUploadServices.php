<?php


namespace app\services\upload;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use think\facade\Log;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/8/1 21:41
 * @version 1.0
 */
class QiniuUploadServices
{
    //AK
    private $accessKey;
    //SK
    private $secretKey;
    //七牛云桶名
    private $bucket;
    //存储域名
    private $yzurl;

    public function __construct()
    {
        $this->accessKey = sys_config('accessKey', 'qiniu', '');
        $this->secretKey = sys_config('secretKey', 'qiniu', '');
        $this->bucket = sys_config('bucket', 'qiniu', '');
        $this->yzurl = sys_config('yzurl', 'qiniu', '');
    }

    //图片
    public function img($image)
    {
        // 获取表单上传文件
        $key = $image->getOriginalName();
        //获取上传后的文件路径
        // 图片存储在本地的临时路经
        $filePath = $image->getRealPath();
        // 获取图片后缀
        $ext = $image->getOriginalExtension();
        // 上传到七牛后保存的新图片名
        $newImageName = substr(md5($image->getOriginalName()), 0, 6)
            . rand(00000, 99999) . '.' . $ext;
        $auth = new Auth($this->accessKey, $this->secretKey);
        // 要上传的空间位置
        $token = $auth->uploadToken($this->bucket);
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $newImageName, $filePath);
        if ($err !== null) {
            return null;
        } else {
            // 图片上传成功
            $da['image'] = $this->yzurl . '/' . $newImageName;
            $da['title'] = $key;
            $da['time'] = date("Y/m/d");
            return $da;
        }
    }

    //文件上传
    public function uploadFile($file)
    {
        $key = $file->getOriginalName();
        //获取上传后的文件路径
        // 文件存储在本地的临时路经
        $filePath = $file->getRealPath();
        // 获取文件后缀
        $ext = $file->getOriginalExtension();
        // 文件到七牛后保存的新文件名
        $newImageName = substr(md5($file->getOriginalName()), 0, 6)
            . rand(00000, 99999) . '.' . $ext;
        $auth = new Auth($this->accessKey, $this->secretKey);
        // 要上传的空间位置
        $token = $auth->uploadToken($this->bucket);
        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $newImageName, $filePath);
        if ($err !== null) {
            return null;
        } else {
            // 文件上传成功
            $da['file'] = $this->yzurl . '/' . $newImageName;
            $da['title'] = $key;
            $da['time'] = date("Y/m/d");
            return $da;
        }
    }

    //删除文件
    public function delete($image_url)
    {
        $len = strlen($this->url);
        //要删除七牛云图片路径
        $delImageUrl = substr($image_url, $len);
        $auth = new Auth($this->accessKey, $this->secretKey);
        $config = new \Qiniu\Config();
        $bucketManager = new \Qiniu\Storage\BucketManager($auth, $config);
        $bucketManager->delete($this->bucket, $delImageUrl);
        return json([
            'msg' => '删除成功',
            'code' => 200,
            'result' => ''
        ]);
    }
}