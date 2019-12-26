<?php
/**
 * Author: Left.Sky
 * Date: 2019/12/26
 * Version: 0.0.1
 */

// 成功
define('ERR_SUCCESS', 0xFFFF0000);
// 普通失败
define('ERR_FAILED', 0xFFFF1000);
// 参数错误
define('ERR_ARGV', 0xFFFF1100);
// 参数不足
define('ERR_ARGV_NO_ENOUGH', 0xFFFF1101);
// 找不到 (需求事件)
define('ERR_NO_FOUND', 0xFFFF2000);
// 找不到硬件
define('ERR_NO_FOUND_HARD', 0xFFFF2001);
// 找不到软件
define('ERR_NO_FOUND_SOFT', 0xFFFF2002);

/**
 * 权限认证 ERR
 */
// API TOKEN 认证失败
define('ERR_API_TOKEN', 0xFFFE0000);
// API 权限 认证失败
define('ERR_API_AUTH', 0xFFFE0001);

function ERR($code)
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
        case ERR_NO_FOUND:
            return '找不到';
        case ERR_NO_FOUND_HARD:
            return '找不到硬件';
        case ERR_NO_FOUND_SOFT:
            return '找不到软件';
        case ERR_API_TOKEN:
            return 'API TOKEN 认证失败';
        case ERR_API_AUTH:
            return 'API 权限 认证失败';
        default:
            return '未知';
    }
}

