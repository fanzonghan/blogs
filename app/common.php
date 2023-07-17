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
    function sys_config(string $name, $default = '')
    {
        if (empty($name))
            return $default;
        $sysConfig = \app\model\SystemConfig::where('name',$name)->find();
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