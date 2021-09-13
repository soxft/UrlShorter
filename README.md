# UrlShorter
>这是一个足够简洁的Url短网址生成器 
>
> This is a simple Url shortener.

# 兼容性

> 在PHP7.X 与 PHP 8.0 下测试通过

# 安装

- step 1: `git clone git@github.com:soxft/UrlShorter.git`
- step 2: 修改 /api/config.php 中填写您的mysql信息 以及网址等
- step 3: 导入/mysql.sql 至您的数据库
- step 4: 配伪静态(/nginx.conf) 目前仅有nginx的伪静态配置, 您也可以尝试转换为Apache及iis的伪静态
- step 5: 开始使用

# API

参考 [https://github.com/soxft/UrlShorter/wiki/API](https://github.com/soxft/UrlShorter/wiki/API)

# 其他
> 请尊重开源协议.
>
> 该版本可能更加面向专业用户,暂时没有设计后台即一键安装功能,后续将会增加.