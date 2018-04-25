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
						<img src="<?php echo ($img["0"]); ?>">
					</div>
					<div class="goods_all_img">
						<i class="left_slither"></i>
						<div class="show_box">
							<ul>
								<?php if(is_array($img)): $i = 0; $__LIST__ = $img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><li><img src="<?php echo ($vol); ?>" class="show_img"></li><?php endforeach; endif; else: echo "" ;endif; ?>
							</ul>
						</div>						
						<i class="right_slither"></i>
					</div>
				</div>
				<div class="goods_synopsis">
					<p class="goods_name"><?php echo ($goods["goods_name"]); ?></p>
					<p class="goods_current_price">现价￥<i><?php echo ($goods["current_price"]); ?></i></p>
					<div class="goods_standard">
						<i class="goods_standard_title">规格</i>
						<?php if(is_array($standard)): $i = 0; $__LIST__ = $standard;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="standard" price="<?php echo ($vo["1"]); ?>"><?php echo ($vo["0"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
					<div class="goods_stock">
						<i>数量</i>
						<div class="checked_num">
							<span class="minus">-</span>
							<span class="now_num">1</span>
							<span class="add">+</span>
						</div>
						<i>库存<em  class="now_stock">100</em>件</i>
					</div>

					<div class="shopping">
						<span class="buy">立即购买</span>
						<span class="add_car">加入购物车</span>
					</div>
				</div>
			</div>
		
			<div class="synopsis_box">
				<?php if(is_array($synopsis)): $i = 0; $__LIST__ = $synopsis;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div>
						<img src="<?php echo ($vo); ?>">
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>

			
		</div>


		<?php echo ($footer); ?>

	</div>