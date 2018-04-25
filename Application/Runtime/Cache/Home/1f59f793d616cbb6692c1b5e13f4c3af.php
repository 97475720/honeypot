<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/lplive_index.css">
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/lplive_home_page.css">
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="/lplive/Public/JS/index.js"></script>
</head>
<body>
	<div id="index">
		
		<?php echo ($header); ?>

		<div id="search_content">
			<h2>搜索结果</h2>
			<p class="seatch_count">搜索<?php echo ($goodName); ?>约<?php echo ($count); ?>条</p>
			<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div>
					<div class="recommend_list">
					<div class="recommend_list_box">
						<div class="recommend_list_img">
							<a href="http://localhost/lplive/index.php/Home/Index/Goods?id=<?php echo ($vo["id"]); ?>" target="_blank"><img src="<?php echo ($vo["goods_img"]["0"]); ?>"></a>
						</div>
						<div class="recommend_list_text">
							<div class="trade_name">
								<a href=""><?php echo ($vo["goods_name"]); ?></a>
							</div>
							<div class="trade_price">
								<i><?php echo ($vo["current_price"]); ?></i>
								<p>加入购物车</p>
							</div>
						</div>
					</div>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			<div class = "page"><?php echo ($page); ?></div>


		</div>

		
		</div>

		<?php echo ($footer); ?>
	</div>
		


</body>
</html>