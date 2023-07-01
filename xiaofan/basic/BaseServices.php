<?php


namespace xiaofan\basic;

use think\facade\Db;
use think\facade\Route as Url;
use xiaofan\utils\JwtAuth;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/1 0:09
 * @version 1.0
 */
class BaseServices
{
    /**
     * 模型注入
     * @var object
     */
    protected $model;

    /**
     * 数据库事务操作
     * @param callable $closure
     * @param bool $isTran
     * @return mixed
     */
    public function transaction(callable $closure, bool $isTran = true)
    {
        return $isTran ? Db::transaction($closure) : $closure();
    }
    /**
     * 获取路由地址
     * @param string $path
     * @param array $params
     * @param bool $suffix
     * @param bool $isDomain
     * @return \think\route\Url
     */
    public function url(string $path, array $params = [], bool $suffix = false, bool $isDomain = false)
    {
        return Url::buildUrl($path, $params)->suffix($suffix)->domain($isDomain)->build();
    }
    /**
     * 创建token
     * @param array $data
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function createToken($data)
    {
        /** @var JwtAuth $jwtAuth */
        $jwtAuth = app()->make(JwtAuth::class);
        return $jwtAuth->createToken($data);
    }
}