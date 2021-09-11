# UrlShorter
>这是一个足够简洁的Url短网址生成器 
>
> This is a simple Url shortener.

# API
>POST/GET /api/url 

## 请求参数:

    url    原网址 (GET方式请先将原网址进行URL编码)(10~255)
    short  自定义端网址 (4~10)
    encode 返回方式 (可选json、xml,默认为json)
   
## 返回:
### json 返回示例
```JSON
//失败
{
    "code": 1001,
    "msg": "url不能为空",
    "url": ""
}
//成功
{
    "code": 0,
    "msg": "success",
    "url": "https://example.com/success"
}
```
### xml 返回示例
```xml
<!-- 失败 -->
<?xml version="1.0" encoding="utf-8"?>
<res>
  <code>-1001</code>
  <msg>url不能为空</msg>
  <url/>
</res>
<!-- 成功 -->
<?xml version="1.0" encoding="utf-8"?>
<res>
  <code>0</code>
  <msg>success</msg>
  <url>https://example.com/success</url>
</res>
```
        


# 其他
> 请尊重开源协议.