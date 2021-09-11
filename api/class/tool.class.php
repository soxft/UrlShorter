<?php

/**
 * 常用工具类
 */
class Tool
{
    /**
     * 随机字符串
     * @param int $length
     * @return string
     */
    public static function randStr(int $n): string
    {
        $characters = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = mt_rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    /**
     * 获取用户IP地址
     * @return string
     */
    public static function getIp(): string
    {
        if (PHP_SAPI !== "cli") {
            $unknown = 'unknown';
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            if (false !== strpos($ip, ',')) $ip = reset(explode(',', $ip));
            return $ip;
        }
        return '127.0.0.1';
    }

    /**
     * 生成XML
     */
    public static function xml_encode(array $arr): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<res>';
        $xml .= xmlProc::create($arr);
        $xml .= '</res>';
        return $xml;
    }
    /**
     * 将parse_url 转换回来 
     * @param array $url
     * @return string
     * @throws Exception
     */
    public static function unparse_url($parsed_url): string
    {
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : '';
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : '';
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }
}

/**
 * xml处理生成类
 */
class xmlProc
{
    public static function create(array $arr)
    {
        $xml = '';
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $xml .= "<$key>";
                $xml .= self::create($value);
                $xml .= "</$key>";
            } else {
                $xml .= '<' . $key . '>' . $value . '</' . $key . '>';
            }
        }
        return $xml;
    }
}
