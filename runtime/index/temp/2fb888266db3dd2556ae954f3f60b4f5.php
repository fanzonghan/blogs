<?php /*a:2:{s:78:"/mnt/hgfs/project/project/小范博客/blogs/app/index/view/article/index.html";i:1688136493;s:69:"/mnt/hgfs/project/project/小范博客/blogs/app/index/view/base.html";i:1688133791;}*/ ?>
<!DOCTYPE html>
<html lang="zh-Hans">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,maximum-scale=1">
        <title><?php echo htmlentities($title); ?>-<?php echo sys_config('title'); ?></title>
        <meta name="keywords" content="<?php echo sys_config('keywords'); ?>">
        <link href="/static/style.css" rel="stylesheet" type="text/css"/>
        <script src="/static/js/jquery-3.6.1.js"></script>
        <meta name="description" content="<?php echo sys_config('description'); ?>" />
    </head>
    <body>
    
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
      <div class="tzt-panel_hd">
        <div class="tzt-panel_bread">
          <span>当前位置：</span>
          <a href="#" >首页</a>
          <a href="#" ><?php echo htmlentities($article_data['classify']); ?></a>
        </div>
      </div>
      <article class="tzt-panel_bd">
        <h1 class="tzt-article_title mb15"><?php echo htmlentities($article_data['title']); ?></h1>
        <div class="tzt-article_subtit text-muted mb15">
          <span class="m-hidden">栏目：</span>
          <a class="text-link" href="#" ><?php echo htmlentities($article_data['classify']); ?></a>
          <span class="split-line"></span>
          <span class="m-hidden">作者：</span><?php echo htmlentities($article_data['author']); ?>
          <span class="split-line"></span>
          <span class="m-hidden">时间：</span><?php echo htmlentities($article_data['add_time']); ?>
        </div>
        <div class="tzt-article_content mb15" id="viewer">
          <?php echo $article_data['content']; ?>
        </div>
        <div class="tzt-article_tag mb15">
          <?php foreach($article_data['tag'] as $item): ?>
            <a class="btn btn-mini btn-border" href="#" title='记账'><?php echo htmlentities($item); ?></a>
          <?php endforeach; ?>
        </div>
      </article>
      <div class="text-muted">阅读：394次</div>
    </div>

    <div class="tzt-panel">
      <div class="tzt-panel_bd clearfix">
        <p>
          <strong>上一篇：</strong><a href="#" >关于前后端分离导致session失效取值为空的问题解决</a>
        </p>
        <p class="margin-0">
          <strong>下一篇：</strong><a href="#" >解决Tomcat控制台中文乱码的两种方式</a>
        </p>
      </div>
    </div>

    <div class="tzt-panel">
      <div class="tzt-panel_hd">
        <h3>相关文章</h3>
      </div>
      <div class="tzt-panel_bd clearfix">
        <?php foreach($relevant_list as $item): ?>
        <p>
          <a href="/article/<?php echo htmlentities($item['id']); ?>" >开源一款简单好看的记账系统，支持APP-微信小程序-H5</a>
        </p>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="tzt-panel">
      <label id="AjaxCommentBegin"></label>
      <!--评论框-->
      <div id="comment-post" class="mt15"></div>
      <div class="mt15" id="divCommentPost">
        <div class="tzt-panel_hd">
          <a class="pull-right" id="cancel-reply" href="javascript:;" style="display:none;">
            <i class="iconfont icon-delete"></i>
          </a>
          <h3>我要留言</h3>
        </div>
        <div class="tzt-panel_bd">
          <div class="post">
            <form id="frmSumbit" target="_self" method="post" action="http://www.xiaofan.ink/zb_system/cmd.php?act=cmt&postid=31&key=c06beb53273a85608c47e9162136badb" >
              <input type="hidden" name="inpId" id="inpId" value="31" />
              <input type="hidden" name="inpRevID" id="inpRevID" value="0" />
              <div class="tzt-comment_input">
                <p><input type="text" name="inpName" id="inpName" class="form-control text" value="访客" size="28" tabindex="1" placeholder="名称" /></p>
                <p class="center"><input type="text" name="inpEmail" id="inpEmail" class="form-control text" value="" size="28" tabindex="2" placeholder="邮箱" /></p>
                <p><input type="text" name="inpHomePage" id="inpHomePage" class="form-control text" value="" size="28" tabindex="3" placeholder="主页" /></p>
              </div>
              <p><textarea name="txaArticle" id="txaArticle" class="form-control text" cols="50" rows="4" tabindex="5" placeholder="请输入内容" ></textarea></p>
              <p>
                <input type="text" name="inpVerify" id="inpVerify" class="form-control text" value="" tabindex="4"  placeholder="验证码" style="display: inline-block; max-width: 120px; margin-right: 10px;">
                <img src="#">
              </p>
              &nbsp;&nbsp;
              <div class="text-center">
                <button type="submit" tabindex="6" onclick="return zbp.comment.post()" class="btn btn-blue btn-width submit"><i class="iconfont icon-fillin"></i> 提交留言</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="tzt-dialog bottom" id="DialogComment">
        <div class="page-bd">
          <div class="tzt-panel">
            <div id="comment-box"></div>
          </div>
        </div>
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
    </body>
</html>
