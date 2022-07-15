<?php

/**
 * 处理网址缩短
 */

require_once CLASS_ROOT . "url.php";
require_once CLASS_ROOT . "punycode/Punycode.php";


class url extends Urllib
{
    private object $conn;
    private array  $param;
    private string $method;

    function __construct(object $conn,array $param,string $method)
    {
        $this->conn = $conn;
        $this->param = $param;
        $this->method = $method;
        parent::__construct($conn);
    }

    public function run(): array
    {   
        if (!isset($this->param['url'])) return ['code' => 1001,'msg' => 'URL不能为空'];
        return parent::getShort($this->param['url'], $this->param['short'] ?? '');
    }
}
