<?php
use yii\helpers\Url;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="<?= Url::to('@web/css/honeypot.css') ?>" rel="stylesheet">
</head>
<body>

<div id="warp">
    <?= $content; ?>
    <div id="footer">
        <div class="log-container">
            <img src="<?= Url::to('@web/images/log.png') ?>">
            <span>蜜罐，做生活设计师</span>
        </div>
    </div>
</div>

</body>
</html>
