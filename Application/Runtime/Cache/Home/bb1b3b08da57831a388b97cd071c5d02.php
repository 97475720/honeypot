<?php if (!defined('THINK_PATH')) exit();?><div id="header">

			<div id="header_top">
				
				<div class="header_service">	
					<span>
						<i class="header_service_phone">15502810509</i>
					</span>	
					<span >
						<i class="header_service_manpower">客服服务</i>
					</span>
				</div>
				<?php if($user): ?><div class="header_user">
							<a class="header_img" href="http://localhost/lplive/index.php/Home/Information/userInformation">
								<img src=<?php if($user["headpicture"] != null): ?>"<?php echo ($user["headpicture"]); ?>"<?php else: ?>"/lplive/Public/IMG/timg.jpg"<?php endif; ?>>
							<p class="user_name"><?php echo ($user["unickname"]); ?></p>
							</a>
							<p class="user_cancel">注销</p>
					</div>

				<?php else: ?> 
					<div class="header_inline">
						<span>
							<a class="header_login" href="http://localhost/lplive/index.php/Home/Login/login">登录</a>
						</span>	
						<span >
							<a class="header_sign" href="http://localhost/lplive/index.php/Home/Login/sign">注册</a>
						</span>
					</div><?php endif; ?>
				

			</div>

			<div id="header_content">

				
				<div class="content_nav">
					
					<div class="nav_box">
						
						<a href="http://localhost/lplive/index.php/Home/Index/index" class="nav_logo"><img src="/lplive/Public/IMG/logo.png"></a>		
						
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