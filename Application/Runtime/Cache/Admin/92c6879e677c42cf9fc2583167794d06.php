<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
	<style type="text/css">
		body,div,form,input,p{margin: 0;padding: 0;font-family: "微软雅黑";}
		a{text-decoration: none;}
		input{outline: none;}
		.index{width: 100%; height: 100%}
		.login_box{width: 500px; height: auto; border: 1px solid #eee; border-radius: 10px; box-shadow: 0 0 8px 3px #eee; margin: 200px auto;
					padding-top: 50px;}
		.login_box>form{width: 400px; height: auto; margin: 0 auto; }
		.input_box{width: inherit; height: auto; margin-bottom: 10px;}
		.input_box>span{width: 120px;height: 30px;line-height: 30px;display: inline-block;padding-right: 20px; color:#7A8998; text-align: 				right;}
		.input_box>input{width: 200px;height: 28px;line-height: 28px;display: inline-block;color:#7A8998;border: 1px solid #eee;text-indent: 			  10px}
		.input_box>p{height: 30px; font-size: 12px; margin-left: 151px; line-height: 30px;}
		.login_submit{width: 120px;height: 40px; line-height: 40px; color: white; background: #38A666;border-radius: 6px; margin: 30px auto;text-align: center;cursor: pointer;-moz-user-select: none;-khtml-user-select: none;user-select: none;}
		.input_box>.error_border{border-color: red;}
		.input_box>.error{color: red;}
	</style>
</head>
<body>
	<div class="index">
		<div class="login_box">
			<form>
				<div class="input_box">
					<span>账号：</span>
					<input class="input_uid" type="text" placeholder="电话/邮箱" />
					<p class="input_uid_tips"></p>
				</div>
				<div class="input_box">
					<span>密码：</span>
					<input class="input_upwd" type="password" placeholder="请输入密码" />
					<p class="input_upwd_tips"></p>
				</div>
			</form>
			<div class="login_submit">登录</div>
		</div>
	</div>
	<script type="text/javascript">
		$(".login_submit").click(function(){
			var uid = $(".input_uid").val();
			var upwd = $(".input_upwd").val();
			if(uid==""){
				$(".input_uid").addClass("error_border");
				$(".input_uid_tips").addClass("error").text("请输入电话或者邮箱");
				return;
			}else{
				$(".input_uid").removeClass("error_border");
				$(".input_uid_tips").removeClass("error").text("");
			}
			if(upwd==""){
				$(".input_upwd").addClass("error_border");
				$(".input_upwd_tips").addClass("error").text("请输入密码");
				return;
			}else{
				$(".input_upwd").removeClass("error_border");
				$(".input_upwd_tips").removeClass("error").text("");
			}
			console.log(uid);
			console.log(upwd);
			$.post("http://localhost/lplive/index.php/Admin/Login/login",{num:uid,upwd:upwd},function(data){
				if(data.status=="1001"){
					window.location.href=("http://localhost/lplive/index.php/Admin/Admin/admin");
				}else{
					$(".input_uid").addClass("error_border");
					$(".input_uid_tips").addClass("error").text(data.msg);
				}
			})
		})

	</script>
</body>
</html>