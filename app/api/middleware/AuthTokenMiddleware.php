<?php


namespace app\api\middleware;

use app\Request;
use xiaofan\utils\JwtAuth;

class AuthTokenMiddleware
{
    public function handle(Request $request,\Closure $next){
        //toke 合法性验证
        $header = $request->header();
        //判读请求头里有没有token
        if(!isset($header['token'])){
            return json(['code'=>4001,'msg'=>'token不存在']);
        }
        $token = $header['token'];
        try {
            // token 合法
            /** @var JwtAuth $Jwtauth */
            $Jwtauth = app()->make(JwtAuth::class);
            $tokenData = $Jwtauth->checkToken($token);
            $userInfo = $tokenData['data'];
            Request::macro('tokenData', function () use (&$tokenData) {
                return $tokenData;
            });
        }catch (\Exception $e){
            return json(['code'=>$e->getCode(),'msg'=>$e->getMessage()]);
        }

        return $next($request);
    }
}