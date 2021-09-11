<?php

/**
 * 数据库连接类
 */

try {
    $dsn = "mysql:host=" . DB[0] . ";dbname=" . DB[1];
    $conn = new PDO($dsn, DB[2], DB[3]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //设置报错模式
} catch (PDOException $e) {
    $arr = ['code' => 1001, 'msg' => "系统错误,请稍后再试"];
    if (DEBUG) $arr['err'] = $e->getMessage();

    header("content-type:text/json; charset=utf-8");
    exit(json_encode($arr));
}
