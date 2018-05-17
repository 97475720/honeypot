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
<div id="info-warp">
    <div id="info-content">
        <div class="user-info-container">
            <div class="user-info">
                <span class="info-photo-position">
                    <img src="/honeypot/Public/images/search_test.jpg">
                </span>
                <span class="info-nickname">这是测试测试测试用的这是测试测试测试用的这是测试测试测试用的这是测试测试测试用的</span>
                <span class="info-message">
                    <img src="/honeypot/Public/images/message.jpg">
                    <i>34</i>
                </span>
            </div>
            <div class="user-operate-data">
                <div class="user-collect-data">
                    <a><p>12</p></a>
                    <span>收藏</span>
                </div>
                <div class="user-publish-data">
                    <a><p>12</p></a>
                    <span>发布</span>
                </div>
            </div>
        </div>
    </div>
    <div id="user-publish-cases">
        <div class="user-publish-list cases-list">
            <a>
                <img class="case-img" src="/honeypot/Public/images/search_test.jpg">
            </a>
            <div class="operate-box">
                <p class="cases-title">蓝色空间</p>
                <div>
                    <img src="/honeypot/Public/images/collect.jpg">
                    <span>789</span>
                </div>
                <div>
                    <img src="/honeypot/Public/images/comment.jpg">
                    <span>798</span>
                </div>
            </div>
        </div>
        <div class="publish-cases cases-list">
            <a href="<?php echo U('Index/releaseCases');?>"><img src="/honeypot/Public/images/publish.jpg"></a>
            <p>发布作品</p>
        </div>
    </div>
    <div class="pagination-container">
        <div class="pagination">
            <?php echo ($show); ?>
        </div>
    </div>
</div>
<div class="message-modal">
    
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