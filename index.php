<?php
// 判断跳转 OR 显示页面
require_once "api/config.php";
$short = $_GET['short'] ?? '';

if ($short === '') {
    require_once "web/index.php";
    exit;
}

require_once INCLUDE_ROOT . "db.php";
require_once CLASS_ROOT . "url.php";

require_once "proc/index.php";
