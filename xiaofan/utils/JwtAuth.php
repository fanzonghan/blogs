<?php

namespace xiaofan\utils;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuth
{
    /**
     * 生成验签
     * @param $data
     * @return mixed
     */
    public function signToken($data){
        $key='abcdefg';         //自定义的一个随机字串用户于加密中常用的 盐  salt
        $token=array(
            "iss"=>app()->request->host(),        //签发者 可以为空
            "aud"=>app()->request->host(),          //面象的用户，可以为空
            "iat"=>time(),      //签发时间
            "nbf"=>time(),      //在什么时候jwt开始生效
//            "exp"=> strtotime('+ 30day'),  //token 过期时间
            "exp"=> time()+300,  //token 过期时间
            "data"=>$data
        );
        $jwt = JWT::encode($token, $key, "HS256");  //生成了 token
        return $jwt;
    }
    /**
     * 验证token
     * @param $token
     * @return array|int[]
     */
    public function checkToken($token){
        $key='abcdefg';     //自定义的一个随机字串用户于加密中常用的 盐  salt
        $res['status'] = false;
        try {
            JWT::$leeway    = 60;//当前时间减去60，把时间留点余地
            $decoded        = JWT::decode($token, new Key($key, 'HS256')); //HS256方式，这里要和签发的时候对应
            $arr            = (array)$decoded;
            $res['status']  = 200;
            $res['data']    =(array)$arr['data'];
            return $res;

        } catch(\Firebase\JWT\SignatureInvalidException $e) { //签名不正确
            $res['info']    = "签名不正确";
            return $res;
        }catch(\Firebase\JWT\BeforeValidException $e) { // 签名在某个时间点之后才能用
            $res['info']    = "token失效";
            return $res;
        }catch(\Firebase\JWT\ExpiredException $e) { // token过期
            throw new \think\Exception('token过期',4000);
        }catch(Exception $e) { //其他错误
            $res['info']    = "未知错误";
            return $res;
        }
    }
}
