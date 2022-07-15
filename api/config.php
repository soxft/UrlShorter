<?php

/**
 * 配置文件
 * @author xcsoft <contact@xcsoft.top>
 */

// 用户配置项
const TITLE = 'UrlShorter'; //网站名称

const WEB_URL = 'https://t.cn/'; //网站域名 以 / 结尾

const DB = array('localhost', 'urlshorter', 'urlshorter', 'urlshorter.'); //数据库地址 数据库名 用户名 密码

const DEBUG = false; //是否开启DEBUG模式 (true/false) //建议使用时设定为false

const SHORT_LEN = 5; //短链接长度 (数字)

// 以下内容非特殊情况不要修改 否则可能导致程序无法正常运行

// api文件夹 目录
define("ROOT", dirname(__FILE__));

// CLASS目录 路径
const CLASS_ROOT = ROOT . "/class/";

// includes 目录 路径
const INCLUDE_ROOT = ROOT . "/includes/";

// function 目录 路径
const FUNCTION_ROOT = ROOT . "/functions/";

if (!DEBUG) error_reporting(0);
