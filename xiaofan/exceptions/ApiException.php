<?php


namespace xiaofan\exceptions;

/**
 * @description: 神兽保佑 永无bug
 * @author xiaofan
 * @date 2023/7/13 9:42
 * @version 1.0
 */
class ApiException extends \RuntimeException
{
    public function __construct($message, $replace = [], $code = 0, \Throwable $previous = null)
    {
        if (is_array($message)) {
            $errInfo = $message;
            $message = $errInfo[1] ?? '未知错误';
            if ($code === 0) {
                $code = $errInfo[0] ?? 400;
            }
        }

        parent::__construct($message, $code, $previous);
    }
}