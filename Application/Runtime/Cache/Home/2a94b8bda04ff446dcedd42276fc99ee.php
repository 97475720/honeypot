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
    <div id="top">
        <div class="top-info">
            <div class="top-log">
                <a href="<?php echo U('Index/index');?>">
                    <img src="/honeypot/Public/images/logo.png" />
                </a>
                <a>
                    <span>蜜罐</span>
                </a>
            </div>
            <?php if($user_nickname): ?>
            <p class="user-information">
                        <span>
                            <i>Hi!~</i>
                            <a href="<?php echo U('Index/userInfo');?>"><i class="user-nickname"><?php echo ($user_nickname); ?></i></a>
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
                <input class="index-search-text" type="text" placeholder="搜你喜欢的" />
                <i class="index-btn-search">
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
        <?php if(is_array($hot_cases)): $i = 0; $__LIST__ = $hot_cases;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i; if($vl['style'] == 1): ?>
            <div class="cases-container">
                <div class="cases-img-details cases-details">
                    <a><img src="<?php echo ($vl['cover_img']); ?>"></a>
                </div>
                <div class="cases-info-details cases-details">
                    <p class="cases-sort" style="color:<?php echo ($vl['color']); ?>">
                        <i><?php echo ($vl['index']); ?></i>
                        <em>st</em>
                    </p>
                    <p class="cases-title">
                        <?php echo ($vl['title']); ?>
                    </p>
                    <p class="cases-count">
                        收藏数：<?php echo ($vl['collect_count']); ?>
                    </p>
                    <p class="cases-author">
                        <span>作者：</span>
                        <a><?php echo ($vl['nickname']); ?></a>
                    </p>
                </div>
            </div>
            <?php elseif($vl['style'] == 2): ?>
            <div class="cases-container">
                <div class="cases-info-details cases-details">
                    <p class="cases-sort" style="color:<?php echo ($vl['color']); ?>">
                        <i><?php echo ($vl['index']); ?></i>
                        <em>st</em>
                    </p>
                    <p class="cases-title">
                        <?php echo ($vl['title']); ?>
                    </p>
                    <p class="cases-count">
                        收藏数：<?php echo ($vl['collect_count']); ?>
                    </p>
                    <p class="cases-author">
                        <span>作者：</span>
                        <a><?php echo ($vl['nickname']); ?></a>
                    </p>
                </div>
                <div class="cases-img-details cases-details">
                    <a><img src="<?php echo ($vl['cover_img']); ?>"></a>
                </div>
            </div>
            <?php endif; endforeach; endif; else: echo "" ;endif; ?>
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