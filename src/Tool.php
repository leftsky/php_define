<?php
/**
 * Author: Left.Sky
 * Date: 2020/07/24
 * Version: 0.0.2
 */

namespace leftsky;

use leftsky\Tool as LeftTool;

class Tool
{
    static public function ERR($code)
    {
        switch ($code) {
            case ERR_SUCCESS:
                return '操作成功';
            case ERR_FAILED:
                return '失败';
            case ERR_ARGV:
                return '参数错误';
            case ERR_ARGV_NO_ENOUGH:
                return '参数不足';
            case ERR_API_TOKEN:
                return 'API TOKEN 认证失败';
            case ERR_API_AUTH:
                return 'API 权限 认证失败';
            default:
                return '未知';
        }
    }

    static function rsps($code, $data = null, $msg = null)
    {
        return $response = response([
            "code" => $code,
            "msg" => $msg ?? Tool::ERR($code),
            "data" => $data
        ]);
    }

    // 判断是否是json
    static function is_json($string)
    {
        try {
            json_decode($string);
        } catch (\Exception $e) {
            return false;
        }
        return (json_last_error() == JSON_ERROR_NONE);
    }

    // 请将这段代码复制到api.php中
    private function shouldCopy()
    {

        function rsps($code, $data = null, $msg = null)
        {
            LeftTool::rsps($code, $data = null, $msg = null);
        }

        function is_json($string)
        {
            return LeftTool::is_json($string);
        }
    }
}


// 成功
define('ERR_SUCCESS', 0xFFFF0000);
// 普通失败
define('ERR_FAILED', 0xFFFF1000);
// 参数错误
define('ERR_ARGV', 0xFFFF1100);
// 参数不足
define('ERR_ARGV_NO_ENOUGH', 0xFFFF1101);

/**
 * 权限认证 ERR
 */
// API TOKEN 认证失败
define('ERR_API_TOKEN', 0xFFFE0000);
// API 权限 认证失败
define('ERR_API_AUTH', 0xFFFE0001);
