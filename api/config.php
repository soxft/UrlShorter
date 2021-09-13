<?php

/**
 * 配置文件
 * @author xcsoft <contact@xcsoft.top>
 */

// 用户配置项
define('TITLE', 'UrlShorter'); //网站名称

define('WEBURL', 'http://t.cn/'); //网站域名 以 / 结尾

define('DB', array('localhost', 'urlshorter', 'urlshorter', 'urlshorter.')); //数据库地址 数据库名 用户名 密码 

define('DEBUG', false); //是否开启DEBUG模式 (true/false) //建议使用时设定为false

define('SHORT_LEN', 5); //短链接长度 (数字)

// 以下内容非特殊情况不要修改 否则可能导致程序无法正常运行

define('ROOT', dirname(__FILE__)); //api文件夹 目录

define('CLASSROOT', ROOT . "/class/"); //CLASS目录 路径

define('INCLUDEROOT', ROOT . "/include/"); //include目录 路径

define('FUNCTIONROOT', ROOT . "/function/"); //funciton目录 路径

if (!DEBUG) error_reporting(0);
