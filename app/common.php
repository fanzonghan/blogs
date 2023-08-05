<?php
// 应用公共文件

use app\services\BlogrollServices;
use app\services\CategoryServices;

const DS = '/';

if (!function_exists('sys_config')) {
    /**
     * 获取系统单个配置
     * @param string $name
     * @param string $default
     * @return string
     */
    function sys_config(string $name,$group = '', $default = '')
    {
        if (empty($name))
            return $default;
        $sysConfig = \app\model\SystemConfig::where('name',$name)->when(!empty($group), function ($query)use($group){
            $query->where('group',$group);
        })->find();
        return $sysConfig['value'];
    }
}
if(!function_exists('blogroll_list')){
    function blogroll_list(){
        /** @var BlogrollServices $BlogrollServices */
        $BlogrollServices = app()->make(BlogrollServices::class);
        return $BlogrollServices->list();//友情链接
    }
}
if(!function_exists('menus')){
    function menus(){
        /** @var CategoryServices $CategoryServices */
        $CategoryServices = app()->make(CategoryServices::class);
        return $CategoryServices->list();//分类
    }
}
if(!function_exists('get_user_ip')){

    /**
     * 获取用户真实IP
     * @param int $type
     * @param bool $adv
     * @return mixed
     * @Date: 2021/8/14 11:54
     * @Author wzb
     */
    function get_user_ip($type = 0, $adv = true)
    {
        $type      = $type ? 1 : 0;
        static $ip = null;
        if (null !== $ip) {
            return $ip[$type];
        }

        if ($adv) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos = array_search('unknown', $arr);
                if (false !== $pos) {
                    unset($arr[$pos]);
                }
                $ip = trim(current($arr));
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) {
                unset($arr[$pos]);
            }
            $ip = trim(current($arr));
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u", ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}