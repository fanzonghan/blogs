<?php /*a:4:{s:70:"/mnt/hgfs/project/project/小范博客/blogs/app/view/index/index.html";i:1686932853;s:70:"/mnt/hgfs/project/project/小范博客/blogs/app/view/common/head.html";i:1686930876;s:72:"/mnt/hgfs/project/project/小范博客/blogs/app/view/common/header.html";i:1686933356;s:72:"/mnt/hgfs/project/project/小范博客/blogs/app/view/common/footer.html";i:1686930048;}*/ ?>
<!DOCTYPE html>
<html lang="zh-Hans">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,maximum-scale=1">
  <title><?php echo htmlentities($title); ?>-<?php echo sys_config('title'); ?></title>
  <meta name="keywords" content="<?php echo sys_config('keywords'); ?>">
  <link href="/static/style.css" rel="stylesheet" type="text/css"/>
  <meta name="description" content="<?php echo sys_config('description'); ?>" />
</head>
<header class="tzt-header">
    <div class="page-bd">
        <div class="tzt-header_hd pull-left">
            <a href="/" title="<?php echo sys_config('title'); ?>"><?php echo sys_config('title'); ?></a>
        </div>
        <div class="tzt-header_bd pull-left">
            <a href="/"><i class="icon iconfont icon-home" style="margin-left:0;padding-top: 10px;"></i></a>
        </div>
        <div class="tzt-header_ft pull-right">
            <form method="post" name="search" action="/search" class="search-form mb15" id="#form" style="display: inline-block;">
                <div style="position: absolute;right:0;">
                    <button type="submit" style="border-radius: 0 5px 5px 0; background-color: var(--tzt-INDIGO); color: #fff;height:40px;width:60px">搜索</button>
                    <a><i class="icon iconfont icon-classification" style="font-size: 26px;margin-left:0"></i></a>
                </div>
                <input type="text" name="q" class="form-control" placeholder="请输入要搜索的关键词" value="">
            </form>
        </div>
        <div class="xf_navbar">
            <ul>
                <li><a href="/" title="">首页</a></li>
                <?php foreach($menus as $item): ?>
                    <li><a href="/cate&id=<?php echo htmlentities($item['id']); ?>" title=""><?php echo htmlentities($item['name']); ?></a></li>
                <?php endforeach; ?>
                <li><a href="/ly" title="">留言反馈</a></li>
            </ul>
        </div>
    </div>
</header>
<main class="page">
    <div class="page-bd">
        <div class="tzt-panel">
            <div class="tzt-panel_bd mb15">
                <a href="" title="小范的技术博客">
                    <img class="img-responsive img-radius" src="http://www.xiaofan.ink/zb_users/theme/TztCard/upload/top.jpg" alt="小范的技术博客"/>
                </a>
            </div>
            <div class="tzt-panel_bd" id="article_list">
                <a href="/article&id=1" class="tzt-media-box" title="解决Tomcat控制台中文乱码的两种方式">
                    <div class="tzt-media-box_hd">
                        <h3 class="tzt-media-box_title">解决Tomcat控制台中文乱码的两种方式</h3>
                        <div class="tzt-media-box_desc m-hidden">
                            window11下tomcat-9.0.69控制台中文乱码 问题图下 第...
                        </div>
                        <div class="tzt-media-box_time">
                            Java
                            <span class="split-line"></span>
                            2022-11-26 18:20:48
                        </div>
                    </div>
                    <div class="tzt-media-box_bd">
                        <img src="http://www.xiaofan.ink/zb_users/upload/2022/11/20221126182325166945820552611.png" alt="解决Tomcat控制台中文乱码的两种方式">
                    </div>
                </a>
            </div>
            <div class="tzt-panel_ft">
                <ul class="tzt-pagination">
                    <li>
                        <a href="#" >首页</a>
                    </li>
                    <li class="active">
                        <a>1</a>
                    </li>
                    <li>
                        <a href="#" >下一页</a>
                    </li>
                    <li>
                        <a href="#">共3页</a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="tzt-panel">
            <div class="tzt-panel_hd">
                <h3>友情链接</h3>
            </div>
            <div class="tzt-panel_bd">
                <ul class="tzt-link clearfix">
                <?php foreach($blogroll as $item): ?>
                    <a href="<?php echo htmlentities($item['url']); ?>" target="_blank" style="padding: 0 10px 0px 10px"><?php echo htmlentities($item['title']); ?></a>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</main>
<footer class="footer">
    <div class="page-bd">
        <div class="text-center text-muted">
            <?php echo sys_config('copyright'); ?>
        </div>
    </div>
</footer>