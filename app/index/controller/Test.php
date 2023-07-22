<?php


namespace app\index\controller;

use app\Request;
use think\facade\Log;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/18 16:57
 * @version 1.0
 */
class Test
{
    public function test(Request $request){
        Log::error('$request->get()');
        Log::error($request->get());
    }
}