<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/honeypot/Public/css/honeypot.css" rel="stylesheet">
    <link href="/honeypot/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/honeypot/Public/css/sb-admin.css" rel="stylesheet">
</head>
<body>
<div id="warp">
    <!--提示框(点击确定才会隐藏)-->
    <div id="tips-modal">
        <p class="tips-content">图片添加成功</p>
        <div class="tips-btn">
            <span class="btn btn-determine">确定</span>
        </div>
    </div>
    <!--    登录框-->
    <div id="login-container" class="row">
        <div class="login-form form-container">
            <p>
                <img src="/honeypot/Public/images/logo1.jpg">
                <span>蜜罐</span>
            </p>
            <form>
                <div class="form-controller login-username">
                    <input  type="text" maxlength="16" placeholder="请输入用户名" style="ime-mode:disabled" name="username">
                </div>
                <div class="form-controller login-password">
                    <input  type="password" maxlength="16" placeholder="请输入密码" style="ime-mode:disabled" name="password">
                </div>
            </form>
            <div class='submit-container'>
                <span class="login-submit btn">login</span>
            </div>
            <p class="login-error-tips error-tips">
            </p>
        </div>
    </div>
    <!--    注册框-->
    <div id="sign-container">
        <div class="sign-form form-container">
            <p>
                <img src="/honeypot/Public/images/logo1.jpg">
                <span>蜜罐</span>
            </p>
            <form>
                <div class="form-controller sign-username">
                    <input type="text" maxlength="16" placeholder="请输入用户名" style="ime-mode:disable" name="username">
                    <p></p>
                </div>
                <div class="form-controller sign-nickname">
                    <input type="text" maxlength="16" placeholder="请输入昵称" name="nickname">
                    <p></p>
                </div>
                <div class="form-controller sign-password">
                    <input type="password" maxlength="16" placeholder="请输入密码" style="ime-mode:disabled" name="password">
                    <p></p>
                </div>
                <div class="form-controller sign-repassword">
                    <input type="password" maxlength="16" placeholder="请确认密码" style="ime-mode:disabled" name="repassword">
                    <p></p>
                </div>
            </form>
            <div class='submit-container'>
                <span class="sign-submit">sign</span>
            </div>
            <p class="sign-error-tips error-tips">
            </p>
        </div>
    </div>
<div class="common-top">
    <div class="common-log">
        <a href="<?php echo U('Index/index');?>"><img src="/honeypot/Public/images/logo1.jpg" /></a>
        <span>蜜罐</span>
    </div>
    <?php if($user_nickname): ?>
    <div class="common-user-information">
        <span>
            <i>Hi!~</i>
            <a href="<?php echo U('Index/userInfo');?>"><i class="user-nickname"><?php echo ($user_nickname); ?></i></a>
        </span>
        <span class="index-login-out">注销</span>
    </div>
    <?php else: ?>
    <div class="common-sign-login">
        <span class="sign">注册</span>
        <span class="login">登录</span>
    </div>
    <?php endif; ?>
</div>
<div class="search-middle">
    <div class="search-warp">
        <div class="search-box">
            <div class="search-input-container">
                <input class="search-key-word" type="text" placeholder="请输入标题" value="<?php echo ($key_word); ?>">
                <img class="search-btn" src="/honeypot/Public/images/search.jpg">
            </div>
            <div class="search-info">
                <p class="search-count">搜索图片：</p>
                <div class="search-type">
                    <i>排序：</i>
                    <?php if($order_type==1):?>
                    <span class="order-type order-type-active" order_type="1">最新</span>
                    <span class="order-type" order_type="2">最热</span>
                    <?php elseif($order_type==2):?>
                    <span class="order-type" order_type="1">最新</span>
                    <span class="order-type order-type-active" order_type="2">最热</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="search-content-box">
            <?php if(is_array($cases)): $i = 0; $__LIST__ = $cases;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><div class="search-content-list cases-list">
                    <a>
                        <img class="case-img" src="<?php echo ($vl['cover_img']); ?>">
                    </a>
                    <div class="operate-box">
                        <p class="cases-title"><?php echo ($vl['title']); ?></p>
                        <div>
                            <img src="/honeypot/Public/images/collect.jpg">
                            <span><?php echo ($vl['collect_count']); ?></span>
                        </div>
                        <div>
                            <img src="/honeypot/Public/images/comment.jpg">
                            <span><?php echo ($vl['comment_count']); ?></span>
                        </div>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="pagination-container">
        <div class="pagination">
            <?php echo ($show); ?>
        </div>
    </div>
</div>
    <div id="footer">
        <div class="log-container">
            <img src="/honeypot/Public/images/logo.png">
            <span>蜜罐，做生活设计师</span>
        </div>
        <div>

        </div>
    </div>
</div>
<script src="/honeypot/Public/js/jquery-3.1.1.js"></script>
<script src="/honeypot/Public/js/md5.js"></script>
<script src="/honeypot/Public/js/honeypot.js"></script>
</body>
</html>