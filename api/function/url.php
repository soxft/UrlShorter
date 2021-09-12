<?php

/**
 * 处理网址缩短
 */

require_once CLASSROOT . "url.class.php";
require_once CLASSROOT . "punycode/Punycode.php";


class url extends urllib
{
    function __construct($conn,$param,$method)
    {
        $this->conn = $conn;
        $this->param = $param;
        $this->method = $method;
        parent::__construct($conn);
    }

    public function run(): array
    {   
        if (!isset($this->param['url'])) return ['code' => 1001,'msg' => 'URL不能为空'];
        return parent::getShort($this->param['url'],isset($this->param['short']) ? $this->param['short'] : '');
    }
}
