<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		body,div,span,p,h3,input{margin: 0; padding: 0;font-family: "微软雅黑"}
		body{min-width: 1500px}
		input{outline: none;}
		#index{width: 100%; height: 100%}
		#form_box{width: 50%; height: auto; margin: 100px auto; border:1px solid #eee; border-radius: 6px; box-shadow: 0px 3px 10px 0px #eee;}
		#form_box>form{margin-left: 150px;padding-top: 20px;}
		#form_box>h3{width: 100%;height: 50px; border-bottom: 1px solid #eee; text-indent: 20px; line-height: 50px; color: #676A6C;}
		.text_box_list{height: auto; width: 100%; margin-bottom: 20px;}
		.text_box_list>select{height: 30px;line-height: 30px;text-indent: 10px; color: #676A6C; font-size: 14px; width: 150px;outline: none;}
		.text_box_list>select>option{line-height: 30px; height: 100px; color: #676A6C; font-size: 14px; font-family: "微软雅黑"}
		.text_box_list>input{height: 30px; width: 300px;border:1px solid #ddd; border-radius: 4px;font-size: 14px; line-height: 30px;text-indent: 6px;}
		.text_box_list>.text_box_name{display: inline-block; height: 30px; text-align: right; color: #676a6c;width: 180px;margin-right: 20px; line-height: 30px;}
		.text_box_list>p{height: 20px; width: 180px;  margin-left: 200px;margin-top: 5px;line-height: 20px; font-size: 12px;display: none;}
		.text_status_list>.input_radio{width: 30px; height: 20px; vertical-align: middle;}
		.text_status_list{margin-left: 100px; margin-top: 30px;}
		.text_status_list>.text_box_name{height: 30px; width: 80px;text-align: right; color: #676a6c;margin-left: 30px; margin-right:20px;line-height: 30px;}
		.submit_box{width: 100%; height: 100px; margin-top: 30px;}
		#submit{width: 80px;height: 50px; background-color: #1DA939; border-radius: 5px; font-size: 20px; line-height: 50px; text-align: center;
				display: inline-block; margin: 20px 330px 0; color: white; font-weight: bold;}
		.text_box_list>.error{color:red;display: block;}
		.text_box_list>.error_border{border-color: red;}
	</style>
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
</head>
<body>
	<div id="index">
		<div id="form_box">
			<h3>创建管理员：</h3>
			<form>
				<div class="text_box_list">
					<span class="text_box_name">姓名：</span><input type="text" class="input_name" placeholder="请输入姓名"/>
					<p class="name_tips"></p>
				</div>
				<div class="text_box_list">
					<span class="text_box_name">电话号码：</span><input type="text" class="input_phone"  maxlength="11"  placeholder="请输入电话号码"/>
					<p class="phone_tips"></p>
				</div>
				<div class="text_box_list">
					<span class="text_box_name">邮箱：</span><input type="text" class="input_email" placeholder="请输入邮箱"/>
					<p class="email_tips"></p>
				</div>
				<div class="text_box_list">
					<span class="text_box_name">密码：</span><input type="password" class="input_pwd" maxlength="16" placeholder="请输入密码"/>
					<p class="pwd_tips"></p>
				</div>
				<div class="text_box_list">
					<span class="text_box_name">再次确认密码：</span><input type="password" class="input_pwd1" maxlength="16" placeholder="请再次输入密码"/>
				</div> 
				<div class="text_box_list">
					<span class="text_box_name">选择分组：</span>
					<select name="group_selecet">
						<option value="">请选择分组</option>
						<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</div> 
				<div class="text_status_list">
					<span class="text_box_name">启用：</span><input type="radio" name="status"  class="input_radio" checked="checked" value="1" />
					<span class="text_box_name">禁用：</span><input type="radio" name="status"  class="input_radio" value="0"/>
				</div>
			</form>
			<div class="submit_box">
				<span id="submit">提交</span>
			</div>
		</div>
	</div>
	<script type="text/javascript">
			var nameOff = false;
			var phoneOff = false;
			var emailOff = false;
			var pwdOff = false;
			var pwd1Off = false;
			$(".input_name").blur(function(){
				var uname = $(this).val();
				$.post("<?php echo U('Admin/check');?>",{uname:uname},function(data){
					if(data.status=='0000'){
						$('.name_tips').text(data.msg).addClass("error");
						$(".input_name").addClass('error_border');
						$(".input_name").parent().css("margin-bottom","5px");
						nameOff = false;

					}else{
						$('.name_tips').text("").removeClass("error");
						$(".input_name").removeClass("error_border");
						$(".input_name").parent().css("margin-bottom","20px");
						nameOff = true;
					}
				})
			})


			$(".input_phone").blur(function(){
				var uphone = $(this).val();
				$.post("<?php echo U('Admin/check');?>",{uphone:uphone},function(data){
					if(data.status=='0000'){
						$('.phone_tips').text(data.msg).addClass("error");
						$(".input_phone").addClass('error_border');
						$(".input_phone").parent().css("margin-bottom","5px");
						phoneOff = false;

					}else{
						$('.phone_tips').text("").removeClass("error");
						$(".input_phone").removeClass("error_border");
						$(".input_phone").parent().css("margin-bottom","20px");
						phoneOff = true;
					}

				})
			})

			$(".input_email").blur(function(){
				var uemail = $(this).val();
				var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if(filter.test(uemail)){
					$.post("<?php echo U('Admin/check');?>",{uemail:uemail},function(data){
					
						if(data.status=='0000'){
							$('.email_tips').text(data.msg).addClass("error");
							$(".input_email").addClass('error_border');
							$(".input_email").parent().css("margin-bottom","5px");
							emailOff = false;

						}else{
							$('.email_tips').text("").removeClass("error");
							$(".input_email").removeClass("error_border");
							$(".input_email").parent().css("margin-bottom","20px");
							emailOff = true;
						}
					})
				}else{
						$('.email_tips').text("邮箱格式错误").addClass("error");
						$(".input_email").addClass('error_border');
						$(".input_email").parent().css("margin-bottom","5px");
						emailOff = false;
				}

			})

			$('.input_pwd').blur(function(){
				var pwd = $(this).val();
				$.post("<?php echo U('Admin/check');?>",{pwd:pwd},function(data){
					if(data.status=='0000'){
						$('.pwd_tips').text(data.msg).addClass("error");
						$(".input_pwd").addClass('error_border');
						$(".input_pwd").parent().css("margin-bottom","5px");
						pwdOff = false;

					}else{
						$('.pwd_tips').text("").removeClass("error");
						$(".input_pwd").removeClass("error_border");
						$(".input_pwd").parent().css("margin-bottom","20px");
						pwdOff = true;
					}

				})
			})


			$("#submit").click(function(){
				var uname = $(".input_name").val();
				var uphone = $(".input_phone").val();
				var uemail = $(".input_email").val();
				var pwd = $(".input_pwd").val();
				var pwd1 = $(".input_pwd1").val();
				var ustatus = $("input:radio[name=status]:checked").val();
				var group_id = $("select[name='group_selecet']").val();
				if(pwd1==''){
						$('.pwd1_tips').text("请再次确认密码").addClass("error");
						$(".input_pwd1").addClass('error_border');
						$(".input_pwd1").parent().css("margin-bottom","5px");
						pwd1Off = false;
						return;
				}else{
						if(pwd==pwd1){
							$('.pwd_tips').text('').removeClass("error");
							$(".input_pwd1").removeClass('error_border');
							$(".input_pwd").removeClass('error_border');
							$(".input_pwd").parent().css("margin-bottom","20px");
							$(".input_pwd1").parent().css("margin-bottom","20px");
							pwd1Off = true;
						}else{
							$('.pwd_tips').text("两次密码输入不一致").addClass("error");
							$(".input_pwd").parent().css("margin-bottom","5px");
							$(".input_pwd1").parent().css("margin-bottom","20px");
							$(".input_pwd1").addClass('error_border');
							$(".input_pwd").addClass('error_border');
							pwd1Off = false;
							return;
						}
				}
				if(!nameOff||!phoneOff||!emailOff||!pwd||!pwd1)return;
				$.post("<?php echo U('Admin/createAdmin');?>",{uname:uname,uphone:uphone,uemail:uemail,upwd:pwd,ustatus:ustatus,group_id:group_id},function(data){
						if(data.status=='0000'){
							if(data.msg=='该用戶名已存在'||data.msg=='用户名不能为空'){
								$('.name_tips').text(data.msg).addClass("error");
								$(".input_name").addClass('error_border');
								$(".input_name").parent().css("margin-bottom","5px");
								nameOff = false;
							}else if(data.msg=='电话号码不能为空'||data.msg=='电话号码长度不符'||data.msg=='電話格式錯誤'||data.msg=="该电话号码已使用"){
								$('.phone_tips').text(data.msg).addClass("error");
								$(".input_phone").addClass('error_border');
								$(".input_phone").parent().css("margin-bottom","5px");
								phoneOff = false;	
							}else if(data.msg=="邮箱号码不能为空"||data.msg=="该邮箱已使用"||data.msg=="邮箱格式错误"){
								$('.email_tips').text(data.msg).addClass("error");
								$(".input_email").addClass('error_border');
								$(".input_email").parent().css("margin-bottom","5px");
								email = false;
							}else if(data.msg == "请输入6到16位长度的密码"||data.msg=="请输入密码"){
									$('.pwd_tips').text(data.msg).addClass("error");
									$(".input_pwd1").addClass('error_border');
									$(".input_pwd1").parent().css("margin-bottom","5px");
									pwdOff = false;
							}else{
									alert(data.msg);
							}
						}else{
							alert(data.msg);
							window.location.reload();
						}
				})
			})
	</script>
</body>
</html>