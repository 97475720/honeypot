<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\HoneypotAsset;

HoneypotAsset::register($this);
$loginModel = new \frontend\models\LoginForm();

$signModel = new \frontend\models\SignupForm();
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?= Html::csrfMetaTags() ?>
    <link href="<?= Url::to('@web/css/honeypot.css') ?>" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div id="warp">
                <!--    登录框-->
    <div id="login-container" class="row">
        <div class="login-form form-container">
            <p>
                <img src="<?= Url::to('@web/images/logo1.jpg') ?>">
                <span>蜜罐</span>
            </p>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($loginModel, 'username')->textInput(['autofocus' => true , 'placeholder' => '请输入用户名'])->label(false) ?>

            <?= $form->field($loginModel, 'password')->passwordInput(['placeholder' => '请输入密码'])->label(false) ?>

            <div class="form-group login-submit">
                <?= Html::submitButton('登录', ['class' => 'btn', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
            <!--    注册框-->
    <div id="sign-container">
        <div class="sign-form form-container">
            <p>
                <img src="<?= Url::to('@web/images/logo1.jpg') ?>">
                <span>蜜罐</span>
            </p>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($signModel, 'username')->textInput(['autofocus' => true , 'placeholder' => '请输入账号'])->label(false) ?>

            <?= $form->field($signModel, 'nickname')->textInput(['placeholder' => '请输入用户名'])->label(false) ?>

            <?= $form->field($signModel, 'password')->passwordInput(['placeholder' => '请输入密码'])->label(false) ?>

            <?= $form->field($signModel, 'verifyPassword')->passwordInput(['placeholder' => '请确认密码'])->label(false) ?>

            <div class="form-group sign-submit">
                <?= Html::submitButton('注册', ['class' => 'btn', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?= $content; ?>
    <div id="footer">
        <div class="log-container">
            <img src="<?= Url::to('@web/images/logo.png') ?>">
            <span>蜜罐，做生活设计师</span>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>