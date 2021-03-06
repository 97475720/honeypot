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
			<ul>
				<li class="admin_rule">
					<a href="code_rule" target="admin_rule" class="current_page ">验证规则入库</a>
				</li>
				<li class="admin_rule">
					<a href="create_group" target="admin_rule" >创建分组</a>
				</li>
				<li class="admin_rule">
					<a href="create_admin" target="admin_rule" >创建管理员</a>
				</li>
				<li class="admin_rule">
					<a href="group_list" target="admin_rule" >分组列表</a>
				</li>
				<li class="admin_rule">
					<a href="admin_list" target="admin_rule" >管理员列表</a>
				</li>
				<li class="admin_rule">
					<a href="grounding" target="_blank" >新品上架</a>
				</li>
			</ul>
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
			<?php if($admin): ?><div class="head_admin">
					<a href="" targeit="admin_rule">
						<img src="<?php echo ($admin["headpicture"]); ?>">
						<p><?php echo ($admin["uname"]); ?></p>
					</a>
					<i class="loginout">注销</i>					
				</div>
			<?php else: ?>
				<div class="header_line">
					<span>
						<a href="<?php echo U('Login/admin_login');?>"><i class="header_line_login">登录</i></a>
					</span>
				</div><?php endif; ?>
			
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
	$(".loginout").click(function(){
		$.post("http://localhost/lplive/index.php/Admin/Admin/loginOut",function(data){
			if(data.status=='1001'){
				window.location.reload();
			}else{
				alert(data.msg);
			}
		})
	})

</script>
</body>
</html>