<?php


namespace app\services;

use app\model\User;
use think\Model;
use think\Paginator;
use xiaofan\basic\BaseServices;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/1 0:20
 * @version 1.0
 */
class UserServices extends BaseServices
{
    public function list($where, $page, $limit)
    {
        $User = new User();
        $where['is_del'] = 0;
        $list = $User->where($where)->order('add_time desc')->paginate(['page' => $page, 'list_rows' => $limit]);
//        print_r($list);
//        foreach ($list['data'] as &$item){
//            $item['last_time'] = date('Y-m-d H:i:s',$item['last_time']);
//        }
        return $list;
    }

    public function info($uid)
    {
        $User = new User();
        $userInfo = $User->where(['id' => $uid, 'is_del' => 0])->find();
        return $userInfo;
    }
}