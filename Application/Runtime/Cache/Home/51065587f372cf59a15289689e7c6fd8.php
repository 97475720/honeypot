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
        <a href="<?php echo U('Index/userInfo');?>"><img src="/honeypot/Public/images/logo1.jpg" /></a>
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
<div id="release-warp">
    <div class="release-content">
        <div class="release-title">
            <p>上传作品</p>
        </div>
        <div class="release-info">
            <p class="release-info-title">作品信息</p>
            <form class="release-info-form">
                <div class="form-group">
                    <p class="release-tips">*请输入作品名称(最多20字)</p>
                    <input type="text" maxlength="20" placeholder="请输入作品名称" class="release-cases-title form-control">
                </div>
                <div class="form-group">
                    <p class="release-tips">*请输入作品介绍(最多100字)</p>
                    <textarea maxlength="100" placeholder="请输入作品介绍" class="release-cases-synopsis form-control" rows="4"></textarea>
                </div>
                <div class="form-group" style="display: none">
                    <form enctype="multipart/form-data" method="post" id="cases-image" onsubmit="return false">
                        <input type="file" name="file" id="btn-cases-image">
                    </form>
                </div>

            </form>
        </div>
        <div class="release-image">
            <div class="release-image-title">
                <span>上传图片</span>
                <i>注：严禁在互联网上储存、传输、发布淫秽有害信息</i>
            </div>
            <div class="release-image-container">
                <div class="upload-image">
                    <img src="/honeypot/Public/images/publish.jpg" id="upload-cases-image">
                    <p>点击添加图片</p>
                    <span>*仅允许上传不超过2M大小，格式为png、jpg、jpeg、gif的图片，如若上传失败，请检查图片大小及格式是否符合要求。</span>
                </div>
            </div>
        </div>
        <div class="release-operate-container">
            <span class="btn btn-submit-cases">发布作品</span>
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