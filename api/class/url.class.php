<?php

/**
 * 网址缩短核心函数
 */
class urllib
{
    function __construct($conn)
    {
        $this->conn = $conn;
    }

    /**
     * 设置密码
     * @param string $password
     */
    public function setPasswd(string $passwd): void
    {
        $this->passwd = $passwd;
    }

    /**
     * 自定义短链接
     */
    public function setShort(string $short): void
    {
        $this->short = $short;
    }
}
