<?php
use yii\helpers\Url;
?>
<div id="top">
    <div class="top-info">
        <div class="top-log">
            <img src="<?= Url::to('@web/images/logo.png') ?>" />
            <span>蜜罐</span>
        </div>
        <div class="sign-login">
            <span class="sign">注册</span>
            <span class="login">登录</span>
        </div>
    </div>
    <h1 class="top-title">蜜罐，陪你做生活中的设计师</h1>
    <div class="top-search">
        <input class="search-text" type="text" placeholder="搜你喜欢的" />
        <i class="btn-search">
            <img src="<?= Url::to('@web/images/search.png') ?>" >
        </i>
    </div>
    <div class="hot-tag">
        <span>热门搜索:</span>
        <span><a>植物</a></span>
        <span><a>插画</a></span>
        <span><a>插画</a></span>
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
                <img src="<?= Url::to('@web/images/Article.jpg') ?>">
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