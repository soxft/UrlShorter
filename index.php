<?php
    // 判断跳转 OR 显示页面

    if (!isset($_GET['short'])) exit('请检查网址rewrite配置后重试');
    if ($_GET['short'] == '') {
        require_once "web/index.php";
        exit;
    }

    require_once "api/config.php";
    require_once INCLUDEROOT . "db.php";
    require_once CLASSROOT . "url.class.php";
    
    require_once "proc/index.php";