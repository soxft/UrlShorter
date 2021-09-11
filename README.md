# UrlShorter
>这是一个足够简洁的Url短网址生成器 
>
> This is a simple Url shortener.

# API
>POST/GET /api/url 

## 请求参数:

    url    原网址 (GET方式请先将原网址进行URL编码)(10~255)
    short  自定义端网址 (4~10)
    res    返回方式 (可选json、xml,默认为json)
   
## 返回:
### json 返回示例
```JSON
//失败
{
    "code": 1001,
    "msg": "原网址应该在4～255位",
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
<data>
  <code>-1</code>
  <msg>原网址应该在4～255位</msg>
  <url/>
</data>
<!-- 成功 -->
<?xml version="1.0" encoding="utf-8"?>
<data>
  <code>0</code>
  <msg>success</msg>
  <url>https://example.com/success</url>
</data>
```
        


# 其他
> 请尊重开源协议.