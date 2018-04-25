<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		body,div,span,p,h3,input{margin: 0; padding: 0;}
		input{outline: none;}
		#index{width: 100%; height: 100%}
		#form_box{width: 50%; height: auto; margin: 100px auto; border:1px solid #eee; border-radius: 6px; box-shadow: 0px 3px 10px 0px #eee;}
		#form_box>form{margin-left: 100px;}
		#form_box>h3{width: 100%;height: 50px; border-bottom: 1px solid #eee; text-indent: 20px; line-height: 50px; color: #676A6C;}
		.text_box_list{height: auto; width: 100%; margin-top: 20px;}
		.text_box_list>input{height: 30px; width: 300px;border:1px solid #ddd; border-radius: 4px;font-size: 14px; line-height: 30px;text-indent: 6px;}
		.text_box_name{display: inline-block; height: 30px; text-align: right; color: #676a6c;width: 180px;margin-right: 20px; line-height: 30px;}
		.text_box_list>p{height: 20px; width: 180px;  margin-left: 200px;margin-top: 10px;line-height: 20px; font-size: 14px;display: none}
		.text_status_list{margin-top: 30px;}
		.text_status_list>span{display: inline-block; height: 30px; text-align: right;color: #676a6c;width: 80px;margin-left: 100px; line-height: 30px;}
		.text_status_list>.input_radio{width: 30px; height: 20px; vertical-align: middle;}
		.submit_box{width: 100%; height: 100px; margin-top: 30px;}
		#submit{width: 80px;height: 50px; background-color: #1DA939; border-radius: 5px; font-size: 20px; line-height: 50px; text-align: center;display: inline-block; margin: 20px 330px 0; color: white; font-weight: bold;}
		.text_box_list>.error{color:red;display: block;}
		.text_box_list>.error_border{border-color: red;}
	</style>
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
</head>
<body>
	<div id="index">
		<div id="form_box">
			<h3>验证规则入库：</h3>
			<form>
				<div class="text_box_list">
					<span class="text_box_name">控制器：</span><input type="text" class="input_controller" placeholder="请输入控制器"/>
					<p class="controller_tips"></p>
				</div>
				<div class="text_box_list">
					<span class="text_box_name">控制器中文名：</span><input type="text" class="input_controller_name" placeholder="请输入控制器中文名"/>
					<p class="controller_name_tips"></p>
				</div>
				<div class="text_box_list">
					<span class="text_box_name">控制器模块：</span><input type="text" class="input_name" placeholder="请输入控制器模块"/>
					<p class="name_tips"></p>
				</div>
				<div class="text_box_list">
					<span class="text_box_name">控制器模块中文名：</span><input type="text" class="input_title" placeholder="请输入控制器模块中文名"/>
					<p class="title_tips"></p>
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
	 	 var controllerOff = false;
	 	 var controllerNameOff = false;
	 	 var nameOff = false;
	 	 var titleOff = false;

		$(".input_controller").blur(function(){
			var controller = $(this).val();
			if (controller=='') {
				$(this).addClass('error_border');
				$('.controller_tips').addClass('error').text("控制器不能为空");
				controllerOff = false;
			}else{
				$.post("<?php echo U('Admin/checkRule');?>",{controller:controller},function(data){
					if(data.status=='0000'){
						$(".input_controller").addClass('error_border');
						$('.controller_tips').addClass('error').text(data.msg);
						controllerOff = false;
					}else{
						$(".input_controller").removeClass('error_border');
						$('.controller_tips').removeClass('error').text('');
						controllerOff = true;
					}
				})
			}
		})

		$(".input_controller_name").blur(function(){
			var controller_name = $(this).val();
			if (controller_name=='') {
				$(this).addClass('error_border');
				$('.controller_name_tips').addClass('error').text("控制器名不能为空");
				controllerNameOff = false;
			}else{
				$.post("<?php echo U('Admin/checkRule');?>",{controller_name:controller_name},function(data){
					if(data.status=='0000'){
						$(".input_controller_name").addClass('error_border');
						$('.controller_name_tips').addClass('error').text(data.msg);
						controllerNameOff = false;
					}else{
						$(".input_controller_name").removeClass('error_border');
						$('.controller_name_tips').removeClass('error').text('');
						controllerNameOff = true;
					}
				})
			}
		})

		$(".input_name").blur(function(){
			var name = $(this).val();
			if (name=='') {
				$(this).addClass('error_border');
				$('.name_tips').addClass('error').text("验证规则不能为空");
				titleOff = false;
			}else{
				$.post("<?php echo U('Admin/checkRule');?>",{name:name},function(data){
					if(data.status=='0000'){
						$(".input_name").addClass('error_border');
						$('.name_tips').addClass('error').text(data.msg);
						nameOff = false;
					}else{
						$(".input_name").removeClass('error_border');
						$('.name_tips').removeClass('error').text('');
						nameOff = true;
					}
				})
			}
		})

		$(".input_title").blur(function(){
			var title_name = $(this).val();
			if (title_name=='') {
				$(this).addClass('error_border');
				$('.title_tips').addClass('error').text("规则名不能为空");
				titleOff = false;
			}else{
				$.post("<?php echo U('Admin/checkRule');?>",{title:title_name},function(data){
					if(data.status=='0000'){
						$(".input_title").addClass('error_border');
						$('.title_tips').addClass('error').text(data.msg);
						titleOff = false;
					}else{
						$(".input_title").removeClass('error_border');
						$('.title_tips').removeClass('error').text('');
						titleOff = true;
					}
				})
			}
		})

		$('#submit').click(function(){
			var controller = $(".input_controller").val();
			var controller_name = $(".input_controller_name").val();
			var name = $(".input_name").val();
			var title = $(".input_title").val();
			var status = $("input:radio[name=status]:checked").val();
			if(!controllerOff||!controllerNameOff||!nameOff||!titleOff)return;
			$.post("<?php echo U('Admin/createRule');?>",{controller:controller,controller_name:controller_name,name:name,title:title,status:status},function(data){
				if(data.status=='0000'){
					if(data.msg=='控制器不能为空'){
						$(".input_controller").addClass('error_border');
						$('.controller_tips').addClass('error').text(data.msg);
						controllerOff = false;
					}else if(data.msg=='控制器名不能为空'){
						$(".input_controller_name").addClass('error_border');
						$('.controller_name_tips').addClass('error').text(data.msg);
						controllerNameOff = false;
					}else if(data.msg=='验证规则不能为空'||data.msg=="验证规则已存在"){
						$(".input_name").addClass('error_border');
						$('.name_tips').addClass('error').text(data.msg);
						nameOff = false;
					}else if(data.msg=='规则名不能为空'||data.msg=="规则名已存在"){
						$(".input_title").addClass('error_border');
						$('.title_tips').addClass('error').text(data.msg);
						titleOff = false;
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