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
