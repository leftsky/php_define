<?php

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
    function ERR_(int $code): string
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

if (!function_exists('rsps')) {
    if (function_exists('response')) {
        /**
         * laravel 封装回执
         * @param int $code
         * @param null $data
         * @param string|null $msg
         * @return mixed
         */
        function rsps(int $code, $data = null, string $msg = null)
        {
            return $response = response([
                "code" => $code,
                "msg" => $msg ?? ERR_($code),
                "data" => $data
            ]);
        }
    } else {
        /**
         * thinkphp 封装回执
         * @param int $code
         * @param null $data
         * @param string|null $msg
         * @return mixed
         */
        function rsps(int $code, $data = null, string $msg = null)
        {
            return $response = json([
                "code" => $code,
                "msg" => $msg ?? ERR_($code),
                "data" => $data
            ]);
        }
    }
}

if (!function_exists('is_json')) {
    /**
     * 判断是否是json
     * @param $string
     * @return bool
     */
    function is_json($string): bool
    {
        // 如果不是 String 类型就返回 false
        if (!is_string($string)) return false;
        try {
            json_decode($string);
        } catch (\Exception $e) {
            return false;
        }
        if ($string == "null") return false;
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if (!function_exists('explodeOrEmpty')) {
    /**
     * 判断是否是字符串并且切割
     * @param string $string
     * @return array
     */
    function explodeOrEmpty(string $string): array
    {
        if (!$string || !is_string($string) || strlen($string) <= 0) return [];
        return explode(",", $string);
    }
}

if (!function_exists("get_shuxiang")) {
    function get_shuxiang(int $year): string
    {
        $array = array('猴', '鸡', '狗', '猪', '鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊');
        foreach ($array as $key => $value) {
//            echo $key . "..." . $value;
            if (ceil($year % 12) == $key) {
                return $value;
            }
        }
        return "未知";
    }
}
if (!function_exists("get_xingzuo")) {
    function get_xingzuo(int $month, int $day): string
    {
        $xingzuo = '';
        // 检查参数有效性
        if ($month < 1 || $month > 12 || $day < 1 || $day > 31) {
            return $xingzuo;
        }
        if (($month == 1 && $day >= 20) || ($month == 2 && $day <= 18)) {
            $xingzuo = "水瓶";
        } else if (($month == 2 && $day >= 19) || ($month == 3 && $day <= 20)) {
            $xingzuo = "双鱼";
        } else if (($month == 3 && $day >= 21) || ($month == 4 && $day <= 19)) {
            $xingzuo = "白羊";
        } else if (($month == 4 && $day >= 20) || ($month == 5 && $day <= 20)) {
            $xingzuo = "金牛";
        } else if (($month == 5 && $day >= 21) || ($month == 6 && $day <= 21)) {
            $xingzuo = "双子";
        } else if (($month == 6 && $day >= 22) || ($month == 7 && $day <= 22)) {
            $xingzuo = "巨蟹";
        } else if (($month == 7 && $day >= 23) || ($month == 8 && $day <= 22)) {
            $xingzuo = "狮子";
        } else if (($month == 8 && $day >= 23) || ($month == 9 && $day <= 22)) {
            $xingzuo = "处女";
        } else if (($month == 9 && $day >= 23) || ($month == 10 && $day <= 23)) {
            $xingzuo = "天秤";
        } else if (($month == 10 && $day >= 24) || ($month == 11 && $day <= 22)) {
            $xingzuo = "天蝎";
        } else if (($month == 11 && $day >= 23) || ($month == 12 && $day <= 21)) {
            $xingzuo = "射手";
        } else if (($month == 12 && $day >= 22) || ($month == 1 && $day <= 19)) {
            $xingzuo = "摩羯";
        }
        return $xingzuo;
    }
}

if (!function_exists("decode_shuxiang")) {
    function decode_shuxiang(int $year): string
    {
        $array = ['猴', '鸡', '狗', '猪', '鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊'];
        foreach ($array as $key => $value)
            if (intval(ceil($year % 12)) === $key) return $value;
        return "未知";
    }
}

if (!function_exists("check_extensions")) {
    /**
     * 校验是否加载了扩展，全部加载则返回true；未加载直接返回未加载的扩展
     * @param array $extensions
     * @return string|bool
     */
    function check_extensions(array $extensions)
    {
        foreach ($extensions as $extension) {
            if (!extension_loaded($extension)) {
                return $extension;
            }
        }
        return true;
    }
}


if (!function_exists('randomCode')) {
    /**
     * 随机指定长度的字符串
     * @param int $len
     * @param bool $hasNumber
     * @param bool $hasUpCase
     * @return string
     */
    function random_str(int $len = 10, bool $hasNumber = false, bool $hasUpCase = false): string
    {
        $arr = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q",
            "r", "s", "t", "u", "v", "w", "x", "y", "z"];
        if ($hasUpCase)
            $arr = array_merge($arr, ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L",
                "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"
            ]);
        if ($hasNumber)
            $arr = array_merge($arr, ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]);
        $str = "";
        while (strlen($str) < $len) $str .= $arr[rand(0, sizeof($arr) - 1)];
        return $str;
    }
}

if (!function_exists("decode_cityCode")) {
    function decode_cityCode(string $code): string
    {
        $arr = json_decode(file_get_contents(__DIR__ . "/jsons/cityCode.json"), true);
        $cities = $arr["cities"] ?? [];
        return $cities[$code] ?? "未知";
    }
}
