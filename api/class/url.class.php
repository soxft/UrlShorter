<?php

/**
 * 网址缩短核心函数
 */

use TrueBV\Punycode;

class urllib
{
    function __construct($conn)
    {
        $this->conn = $conn;
        $this->ifUserDefine = true; //是否用户自定义短链
        $this->AlreadyExists = false; //是否已经存在
    }

    /**
     * 获取短链对应的长链接
     * @param $short
     * @return array
     */
    function getLongUrl(string $short): array
    {
        try {
            $sel = $this->conn->prepare("SELECT `url` FROM `shorter` WHERE `short` = ? ");
            $sel->execute([$short]);
            $res = $sel->fetch();
            if ($res) return ['code' => 0, 'msg' => 'success', 'url' => $res['url']];
            return ['code' => 404, 'msg' => 'not found', 'data' => ''];
        } catch (PDOException $e) {
            $arr = ['code' => 500, 'msg' => 'error', 'data' => ''];
            if (DEBUG) $arr['err'] = $e->getMessage();
            return $arr;
        }
    }

    /**
     * 生成短链接
     * @param $url
     * @param $short
     * @return array
     */
    public function getShort(string $url, string $short): array
    {
        // 判断是否已经存在
        try {
            //处理URL
            $url = $this->getUrl($url);
            if (!preg_match("/^http(s?):\/\/(?:[A-za-z0-9-]+\.)+[A-za-z]{2,4}+(\/){0,1}+(.*)$/", $url))  return ['code' => 1004, 'msg' => '非法的网址', 'url' => $url];
            if (mb_strlen($url) > 1500 || mb_strlen($url) < 10) return ['code' => 1005, 'msg' => '网址长度应该在10到1500位', 'url' => ''];
            if (!$short) $short = $this->createShort();
            if (!preg_match('/^[a-zA-Z0-9]{0,}$/', $short)) return ['code' => 1002, 'msg' => '短链接必须为字母,数字,组合', 'url' => ''];
            if (strlen($short) > 10 || strlen($short) < 4) return ['code' => 1003, 'msg' => '短链接长度必须在4-10位', 'url' => ''];
            if ($this->checkShort($url, $short)) return ['code' => 1006, 'msg' => '自定义短链接已存在', 'url' => ''];
            return ['code' => 0, 'msg' => 'success', 'url' => WEBURL . $this->addShorter($url, trim($short))];
        } catch (Exception $e) {
            $arr = ['code' => 99999, 'msg' => '系统错误,请重试', 'url' => ''];
            if (DEBUG) $arr['err'] = $e->getMessage();
            return $arr;
        }
    }

    /**
     * 检测短链接是否存在
     * @param string $short
     * @return bool
     */
    public function checkShort(string $url, string $short): bool
    {
        $sel = $this->conn->prepare("SELECT `url` FROM `shorter` WHERE `short` = ? ");
        $sel->execute([$short]);
        $res = $sel->fetch();
        if (!$res) return false;
        if ($url == $res['url']) :
            $this->AlreadyExists = true;
            return false;
        endif;
        return true;
    }

    /**
     * 处理URL
     * @param string $url
     * @return string
     */
    public function getUrl(string $url): string
    {
        $url = urldecode(trim($url));
        $urlArr = parse_url($url);
        if (!isset($urlArr['host'])) return 'Err';
        $Punycode = new Punycode();
        $urlArr['host'] = $Punycode->encode($urlArr['host']);
        $url = Tool::unparse_url($urlArr);
        return $url;
    }

    /**
     * 写入短链
     * @param string $url
     * @param string $short
     * @return array
     */
    private function addShorter(string $url, string $short)
    {
        if ($this->AlreadyExists) return $short;
        //检测是否已经存在
        if (!$this->ifUserDefine) {
            $sel = $this->conn->prepare("SELECT `short` FROM `shorter` WHERE `url` = ? ");
            $sel->execute([$url]);
            $res = $sel->fetch();
            if ($res) return $res['short'];
        }
        $insert = $this->conn->prepare("INSERT INTO `shorter` VALUES ('0', ? , ? , ? , ? )");
        $insert->execute([$short, $url, time(), Tool::getIp()]);
        if ($insert->rowCount() === 0) throw new \Exception('写入短链接失败');
        return $short;
    }

    /**
     * 生成短链
     * @return string
     */
    private function createShort(): string
    {
        while (True) { //重复检测
            $short = Tool::randStr(is_numeric(SHORT_LEN) ? SHORT_LEN : mt_rand(4, 6));
            $checkIfExists = $this->conn->prepare("SELECT * FROM `shorter` WHERE `short` = :short ");
            $checkIfExists->bindParam(':short', $short);
            $checkIfExists->execute();
            if ($checkIfExists->rowCount() == 0) break;
        }
        $this->ifUserDefine = false;
        return $short;
    }
}
