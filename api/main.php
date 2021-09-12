<?php

/**
 * API入口文件
 */
require_once "config.php"; //引用配置文件
require_once CLASSROOT . "main.class.php";
require_once CLASSROOT . "tool.class.php";
require_once INCLUDEROOT . "db.php";

$_GET     && main::SafeFilter($_GET);
$_POST    && main::SafeFilter($_POST);
$_COOKIE  && main::SafeFilter($_COOKIE);
$_REQUEST && main::SafeFilter($_REQUEST);

header('Access-Control-Allow-Origin: *');

if (!isset($_GET['method'])) exit(json_encode(['code' => -1, 'msg' => 'missing params']));

$main = new main($conn, $_GET['method'], $_REQUEST, isset($_REQUEST['method']) ? $_REQUEST['method'] : 'main');
$return = $main->run();

//根据encode类型返回
if (($_REQUEST['encode'] ?? 'json') == 'xml') {
    header("content-type:text/xml; charset=utf-8");
    echo Tool::xml_encode($return);
} else {
    header("content-type:text/json; charset=utf-8");
    echo json_encode($return, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
}
