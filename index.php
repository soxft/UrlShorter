<?php
// 判断跳转 OR 显示页面
require_once "api/config.php";
$short = isset($_GET['short']) ? $_GET['short'] : '';

if ($short == '') {
    require_once "web/index.php";
    exit;
}

require_once INCLUDEROOT . "db.php";
require_once CLASSROOT . "url.class.php";

require_once "proc/index.php";
