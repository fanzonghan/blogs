<?php
// 应用公共文件
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