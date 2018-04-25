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
</head>
<body>
<div id="warp">
    <div id="top">
        <div class="top-info">
            <div class="top-log">
                <img src="/honeypot/Public/images/logo.png" />
                <span>蜜罐</span>
            </div>
            <?php if($user_nickname): ?>
                <p class="user-information">
                    <span>
                        <i>Hi!~</i>
                        <i class="user-nickname"><?php echo ($user_nickname); ?></i>
                    </span>
                    <span class="index-login-out">注销</span>
                </p>
            <?php else: ?>
                <div class="sign-login">
                    <span class="sign">注册</span>
                    <span class="login">登录</span>
                </div>
            <?php endif; ?>
            <h1 class="top-title">蜜罐，陪你做生活中的设计师</h1>
            <div class="top-search">
                <input class="search-text" type="text" placeholder="搜你喜欢的" />
                <i class="btn-search">
                    <img src="/honeypot/Public/images/search.png" >
                </i>
            </div>
            <div class="hot-tag">
                <span>热门搜索:</span>
                <span><a>植物</a></span>
                <span><a>插画</a></span>
                <span><a>插画</a></span>
            </div>
        </div>
    </div>

    <div id="middle-content">
    <div class="recommend-line">
        <i></i>
        <span>人气排行</span>
        <i></i>
    </div>
    <div class="hot-cases">
        <div class="cases-container">
            <div class="cases-details">
                <img src="/honeypot/Public/images/test.jpg">
            </div>
            <div class="cases-details">
                <p class="cases-sort">
                    <i>1</i>
                    <em>st</em>
                </p>
                <p class="cases-title">
                    马来西亚风景
                </p>
                <p class="cases-count">
                    收藏数：
                </p>
                <p class="cases-author">
                    <span>作者：</span>
                    <a>花无缺</a>
                </p>
            </div>
        </div>
        <div class="cases-container">
            <div class="cases-details"></div>
            <div class="cases-details"></div>
        </div>
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