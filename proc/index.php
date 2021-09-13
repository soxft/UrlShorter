<?php

/**
 * 处理jump
 */

$url = new urllib($conn);
$raw_url = $url->getLongUrl($short);
switch ($raw_url['code']) {
    case 0:
        header('Location: ' . $raw_url['url'] ?? '');
        echo 'waiting for jump';
        break;
    case 404:
        header('HTTP/1.1 404 Not Found');
        echo json_encode($raw_url);
        break;
    default:
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode($raw_url);
        break;
}
