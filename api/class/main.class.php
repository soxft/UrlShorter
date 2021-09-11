<?php

/**
 * API入口 类
 */

class Main
{
    function __construct($conn, $method, $params)
    {
    }

    
    public function run()
    {
    }

    public static function SafeFilter(&$arr)
    {
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                if (!is_array($value)) { // 判断是否是数组
                    $value = addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
                    $value = nl2br($value); // 回车转换 
                    $arr[$key] = htmlentities($value); //转换为 HTML 实体
                } else {
                    self::SafeFilter($arr[$key]);
                }
            }
        }
    }
}
