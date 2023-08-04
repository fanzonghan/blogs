// 自定义校验链接
function customCheckLinkFn(text, url) {                                              // JS 语法
    if (!url) {
        return
    }
    if (url.indexOf('http') !== 0) {
        return '链接必须以 http/https 开头'
    }
    return true
}

// 自定义转换链接 url
function customParseLinkUrl(url) {                // JS 语法
    if (url.indexOf('http') !== 0) {
        return `http://${url}`
    }
    return url
}

$(function () {
    //播放完毕
    $('#mp3Btn').on('ended', function () {
        console.log("音频已播放完成");
        $('.mp3Box').css({'background': 'url(/static/image/close.png) no-repeat center bottom', 'background-size': 'cover'});
    });
    //播放器控制
    var audio = document.getElementById('mp3Btn');
    audio.volume = .3;
    $('.mp3Box').click(function () {
        event.stopPropagation();//防止冒泡
        if (audio.paused) { //如果当前是暂停状态
            $('.mp3Box').css({'background': 'url(/static/image/open.png) no-repeat center bottom', 'background-size': 'cover'});
            audio.play(); //播放
        } else {//当前是播放状态
            $('.mp3Box').css({
                'background': 'url(/static/image/close.png) no-repeat center bottom',
                'background-size': 'cover'
            });
            audio.pause(); //暂停
        }
    });
})
$('#search').click(function () {
    let keyword = $('#keyword').val();
    if (keyword == '' || keyword == undefined) {
        layer.msg('搜索内容不能为空');
        return;
    }
    window.location.replace("/search?keyword=" + keyword);
})
var img = $("img");
img.on("contextmenu", function () {
    return false;
});
img.on("dragstart", function () {
    return false;
});
