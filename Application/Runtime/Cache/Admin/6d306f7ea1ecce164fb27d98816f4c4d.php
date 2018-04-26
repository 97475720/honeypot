<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>粮品生活后台管理系统</title>
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/admin_lplive.css">
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
</head>
<body>
<div id="admin">
	<div id="admin_side">
		<div class="admin_logo">
			<i></i>
		</div>
		<div class="side_nav">
			aaaaaaaaaaaaaaaaaaa
		</div>
	</div>
	<div id="admin_content">
		<div class="content_header">
			<div class="header_service">
				<span>
					<i class="header_service_phone">00000000000</i>
				</span>
				<span>
					<i class="header_service_nav">在线客服</i>
				</span>
			</div>
			<div class="header_line">
				<span>
					<i class="header_line_login">登录</i>
				</span>
			</div>
			<div class="content_iframe">
				<iframe src="" name="admin_rule"></iframe>				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".admin_rule").each(function(){
		$(this).mouseover(function(){
			if(!$(this).find('a').hasClass("current_page")){
				$(this).find('a').addClass("mouse_page");
			}
		}).mouseout(function(){
			$(this).find('a').removeClass("mouse_page");
		}).click(function(){
			$(this).find('a').addClass("current_page");
			$(this).siblings().find('a').removeClass("current_page");
			$(this).find('a').removeClass("mouse_page");
		})
	})

</script>
</body>
</html>