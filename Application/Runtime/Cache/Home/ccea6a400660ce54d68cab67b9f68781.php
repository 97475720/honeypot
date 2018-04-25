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
		
		<div id="header">

			<div id="header_top">
				
				<div class="header_service">	
					<span>
						<i class="header_service_phone">15502810509</i>
					</span>	
					<span >
						<i class="header_service_manpower">客服服务</i>
					</span>
				</div>

				<div class="header_inline">
					<span>
						<a class="header_login">登录</a>
					</span>	
					<span >
						<a class="header_sign">注册</a>
					</span>
				</div>

			</div>

			<div id="header_content">

				
				<div class="content_nav">
					
					<div class="nav_box">
						
						<a href="" class="nav_logo"><img src="/lplive/Public/IMG/logo.png"></a>		
						
						<div class="nav_list">
							<ul>
								<li><a href="">商城</a></li>
								<li><a href="">城市伙伴</a></li>
								<li><a href="">商务合作</a></li>
								<li><a href="">企业客户</a></li>
								<li><a href="">产品追溯</a></li>
								<li><a href="">体验之旅</a></li>
							</ul>
						
						</div>
						
						<div class="nav_shopping_car">
							
							<div class="shopping_car_box">
								<a class="shopping_car_img">
									<img src="/lplive/Public/IMG/shopping_car.png">
								</a>
								<a class="shopping_car_p">购物车</a>
							
							</div>	
						
						</div>
					
					</div>
				
				</div>

				<div class="header_search">
					
					<div class="search_box">
						
						<input type="text" placeholder="关键字" class="input_search"/>
						
						<span class="search_botton">
							
						</span>
					
					</div>
				
				</div>
			
			</div>
			
		</div>

		
		<div id="login_model">
			
			<div id="login_form">
				<form>
					<div class="input_box">
						<input type="text" class="login_unum" placeholder="账号：请输入手机号码或邮箱"/>
						<p class="login_unum_tips"></p>
					</div>
					<div class="input_box">
						<input type="password" class="login_upwd" maxlength="24" placeholder="密码：请输入6-24位的数字或字母"/>
						<p class="login_upwd_tips"></p>
					</div>	
					<div class="input_box">
						<div class='code_input'>
						<input type="text" class="login_code" maxlength="4" placeholder="请输入验证码"/>
						<p class="login_code_tips"></p>
						</div>
						<div class="code_img_box">
							<img src="http://localhost/lplive/index.php/Home/verify/verify" id="code_img" >
						</div>
					</div>
				</form>
				<span id="login_submit">登录</span>
			</div>

		</div>



		<div id="footer">
			<div class="footer_nav">
				
				<div class="nav_list_box">
					<p>购物指南</p>
					<a href="">新用户注册</a>
					<a href="">在线下单</a>
					<a href="">支付方式</a>
				</div>
				<div class="nav_list_box">
					<p>配送说明</p>
					<a href="">运费说明</a>
					<a href="">发票说明</a>
					<a href=""></a>
				</div>
				<div class="nav_list_box">
					<p>售后服务</p>
					<a href="">退换货规则</a>
					<a href="">服务保障承诺</a>
					<a href="">验货与签收</a>
				</div>
				<div class="nav_list_box">
					<p>企业服务</p>
					<a href="">企业订购</a>
					<a href="">公司简介</a>
					<a href="">定制专区</a>
				</div>

				<div class="footer_attention">
					
					<p>关注我们：</p>

					<a href="">
						<img src="/lplive/Public/IMG/twitter.png">
					</a>
					
					<div>
						<img src="/lplive/Public/IMG/we_code.png">
						<p>关注我们公众号</p>
					</div>
					<div>
						<img src="/lplive/Public/IMG/app.jpg">
						<p>下载商城APP</p>
					</div>
				</div>

			</div>
			
			<div class="footer_msg">
				<p class="footer_msg_right">企业采购或团购：<i>18516175076</i> （周一至周日 9:00-21:00）</p>
				<p class="footer_msg_left">© 2016 tuweia.cn  沪ICP备08013769号-1</p>
			</div>
		
		</div>

	</div>