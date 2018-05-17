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
<div id="cases-warp">
    <div id="cases-details">
        <div class="cases-writer">
            <div class="cases-title">
                <p><?php echo ($cases['title']); ?></p>
                <span><?php echo date('Y-m-d H:i:s',$cases['created_at'])?></span>
            </div>
            <div class="cases-writer-info">
                <div class="cases-writer-photo">
                    <img src="<?php echo ($cases['photo']); ?>">
                </div>
                <div class="cases-writer-nickname">
                    <span><?php echo ($cases['nickname']); ?></span>
                </div>
            </div>
            <div class="cases-data">
                <div>
                    <img src="/honeypot/Public/images/collect.jpg">
                    <span><?php echo ($cases['collect_count']); ?></span>
                </div>
                <div>
                    <img src="/honeypot/Public/images/comment.jpg">
                    <span><?php echo ($cases['comment_count']); ?></span>
                </div>
            </div>
        </div>
        <p class="cases-details-synopsis"><?php echo ($cases['synopsis']); ?></p>
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