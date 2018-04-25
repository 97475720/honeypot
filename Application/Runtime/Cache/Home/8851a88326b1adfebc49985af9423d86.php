<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/lplive_index.css">
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/lplive_search.css">
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="/lplive/Public/JS/index.js"></script>
</head>
<body>
	<div id="index">
		
		<?php echo ($header); ?>


		<div id="goods_all">
			<div class="goods_content">
				<div class="goods_img_box">
					<div class="goods_show_img">
						<img src="">
					</div>
					<div class="goods_all_img">
						<i class="left_slither"></i>
						<ul>
							<?php if(is_array($$goods["goods_img"])): $i = 0; $__LIST__ = $$goods["goods_img"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($vo); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<i class="right_slither"></i>
					</div>
				</div>
				<div></div>
			</div>
		</div>


		<?php echo ($footer); ?>

	</div>