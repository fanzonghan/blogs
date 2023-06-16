<?php

namespace app\api\controller\v1;

use think\Request;

class Login
{
    public function test(){
        return app('json')->success('aaa');
    }
}
