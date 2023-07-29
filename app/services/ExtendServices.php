<?php


namespace app\services;

use xiaofan\basic\BaseServices;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/28 14:49
 * @version 1.0
 */
class ExtendServices extends BaseServices
{
    /**
     * 百度收录
     * @param $urls
     * @return bool|string
     */
    public function BaiduRecord($urls)
    {
        if(empty($urls))return false;
        $site = sys_config('system_url');
        $token = sys_config('token', 'baidu');
        $api = 'http://data.zz.baidu.com/urls?site=' . $site . '&token=' . $token;
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => $urls,
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $res = curl_exec($ch);
        return json_decode($res,true);
    }
}