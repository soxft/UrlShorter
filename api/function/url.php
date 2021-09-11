<?php

/**
 * 处理网址缩短
 */

require_once CLASSROOT . "url.class.php";

class url extends urllib
{
    function __construct($conn)
    {
        $this->conn = $conn;
        parent::__construct($conn);
    }

    public function run(): array
    {
        return [];
    }
}
