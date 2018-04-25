<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/lplive_index.css">
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/lplive_sign.css">
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="/lplive/Public/JS/index.js"></script>
</head>
<body>
	<div id="index">
			
 		<?php echo ($header); ?>
		
		<div id="user_information_box">
			<div class="user_head">				
				<a href="">
					<?php if($user["headpicture"] != null): ?><img src="<?php echo ($user["headpicture"]); ?>" class="head_picture">
					<?php else: ?>
						<img src="/lplive/Public/IMG/timg.jpg" class="head_picture"><?php endif; ?>
					<p><?php echo ($user["unickname"]); ?></p>
				</a>
			</div>
			<div class="head_collect">
				<ul>
					<li><a href="">全部订单</a></li>
					<li><a href="">待付款</a></li>
					<li><a href="">待收货</a></li>
					<li><a href="">待发货</a></li>
				</ul>
			</div>
			<div class="user_all">
				<a href="http://localhost/lplive/index.php/Home/Information/saveInformation"><span>个人资料</span><i>></i></a>
				<a href=""><span>我的订单</span><i>></i></a>
				<a href=""><span>收货地址</span><i>></i></a>
				<a href=""><span>购物车</span><i>></i></a>
				<a href=""><span>修改密码</span><i>></i></a>
				<a href=""><span>分销</span><i>></i></a>
				<a href=""><span>账户设置</span><i>></i></a>
				<a href=""><span>用户设置</span><i>></i></a>
			</div>
			
		</div>



		<?php echo ($footer); ?>

	</div>

</body>
</html>