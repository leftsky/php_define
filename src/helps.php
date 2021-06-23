<?php
/**
 * Author: Left.Sky
 * Date: 2021/06/23
 * Version: 0.1.2
 */

// 成功
define('ERR_SUCCESS', 0xFFFF0000);
// 普通失败
define('ERR_FAILED', 0xFFFF1000);
// 请先登录
define('ERR_NOT_LOGIN', 0xFFFF1001);
// 非所有者
define('ERR_NOT_OWNER', 0xFFFF1002);
// 权限不匹配
define('ERR_COMPETENCE', 0xFFFF1003);
// 参数错误
define('ERR_ARGV', 0xFFFF1100);
// 参数不足
define('ERR_ARGV_NO_ENOUGH', 0xFFFF1101);
// 请刷新
define('ERR_NEED_FLUSH', 0xFFFF1102);

/**
 * 权限认证 ERR
 */
// API TOKEN 认证失败
define('ERR_API_TOKEN', 0xFFFE0000);
// API 权限 认证失败
define('ERR_API_AUTH', 0xFFFE0001);

if (!function_exists('ERR_')) {
    function ERR_($code)
    {
        switch ($code) {
            case ERR_SUCCESS:
                return '操作成功';
            case ERR_FAILED:
                return '失败';
            case ERR_NOT_LOGIN:
                return '请先登录';
            case ERR_NOT_OWNER:
                return '非所有者';
            case ERR_COMPETENCE:
                return '权限不匹配';
            case ERR_ARGV:
                return '参数错误';
            case ERR_ARGV_NO_ENOUGH:
                return '参数不足';
            case ERR_API_TOKEN:
                return 'API TOKEN 认证失败';
            case ERR_API_AUTH:
                return 'API 权限 认证失败';
            case ERR_NEED_FLUSH:
                return '请刷新后重试';
            default:
                return '未知';
        }
    }
}

if (!function_exists('rsps') && function_exists('response')) {
    /**
     * laravel 封装回执
     * @param $code
     * @param null $data
     * @param null $msg
     * @return mixed
     */
    function rsps($code, $data = null, $msg = null)
    {
        return $response = response([
            "code" => $code,
            "msg" => $msg ?? ERR_($code),
            "data" => $data
        ]);
    }
}

if (!function_exists('is_json')) {
    /**
     * 判断是否是json
     * @param string $string
     * @return bool
     */
    function is_json(string $string)
    {
        try {
            json_decode($string);
        } catch (\Exception $e) {
            return false;
        }
        if ($string == "null") {
            return false;
        }
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('explodeOrEmpty')) {
    /**
     * 判断是否是字符串并且切割
     * @param $string
     * @return array
     */
    function explodeOrEmpty($string)
    {
        if (!$string || !is_string($string) || strlen($string) <= 0) {
            return [];
        }
        return explode(",", $string);
    }
}