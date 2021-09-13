$('title').append(' - Powered by xcsoft');
console.log('copyright xcsoft 2021')

$(document).ready(function () {
    $('.mainFrom .submit').text('缩短')
    $('.mainFrom .submit').removeAttr('disabled')
    $('.mainFrom .submit').click(function () {
        $('.mainFrom .submit').text('请稍等')
        $('.mainFrom .submit').attr('disabled', 'disabled')

        var url = $('.mainFrom .url').val()
        var short = $('.mainFrom .short').val()
        
        $('#successModal .qrcode').empty()

        $.ajax({
            url: 'api/url',
            type: 'POST',
            timeout: 10000,
            data: {
                url: url,
                short: short,
                encode: 'json',
            },
            success: function (res) {
                if (res.code !== 0) {
                    layer.msg(res.msg)
                } else {
                    $('.mainFrom .url').val('')
                    $('.mainFrom .short').val('')
                    $('#successModal').modal('show');

                    $('#successModal .qrcode').qrcode({
                        width: 150,
                        height: 150,
                        render: "table",
                        correctLevel: 0,
                        text: res.url
                    });

                    $("#successModal .shortUrl").text(res.url)
                    $("#successModal .shortUrl").attr('data-clipboard-text', res.url)

                    new ClipboardJS("#successModal .shortUrl");
                    $("#successModal .shortUrl").click(function () {
                        layer.msg('链接已复制')
                    })
                }

                $('.mainFrom .submit').text('缩短')
                $('.mainFrom .submit').removeAttr('disabled')
            },
            complete: function (Xhr, status) {
                if (status == "timeout") layer.msg("服务器请求超时,请稍后重试");
                if (status != "success") {
                    layer.msg("服务器错误,请稍后重试");
                    $('.mainFrom .submit').text('缩短')
                    $('.mainFrom .submit').removeAttr('disabled')
                }
            }
        })

        return false;
    })
})