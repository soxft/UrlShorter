<?php

/**
 * API入口 类
 */

class Main
{
    function __construct(object $conn, string $method, array $param, string $apiMethod)
    {
        $this->conn = $conn;
        $this->method = $method;
        $this->param = $param;
        $this->apiMethod = $apiMethod;
    }


    public function run(): array
    {
        if (!self::checkFileExist($this->method)) {
            header("HTTP/1.1 404 NOT FOUND");
            return ['code' => 1, 'msg' => 'method not exist'];
        }

        require_once FUNCTIONROOT . $this->method . '.php';
        if (!class_exists($this->method) || !method_exists($this->method, 'run')) {
            header("HTTP/1.1 404 NOT FOUND");
            return ['code' => 2, 'msg' => 'method not exist'];
        }

        $func = new $this->method($this->conn, $this->param, $this->apiMethod);
        return $func->run();
    }

    private static function checkFileExist(string $filePath): bool
    {
        if (file_exists(FUNCTIONROOT . $filePath . '.php')) return true;
        return false;
    }


    public static function SafeFilter(&$arr)
    {
        if (is_array($arr)) {
            foreach ($arr as $key => $value) {
                if (!is_array($value)) { // 判断是否是数组
                    $value = addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
                    $value = nl2br($value); // 回车转换 
                    $arr[$key] = $value;
                } else {
                    self::SafeFilter($arr[$key]);
                }
            }
        }
    }
}
