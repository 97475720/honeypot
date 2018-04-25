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
		#form_box>form{margin-left: 100px;padding-top: 20px;}
		#form_box>h3{width: 100%;height: 50px; border-bottom: 1px solid #eee; text-indent: 20px; line-height: 50px; color: #676A6C;}
		.text_box_list{height: auto; width: 100%; margin-bottom: 20px;}
		.text_box_list>input{height: 30px; width: 300px;border:1px solid #ddd; border-radius: 4px;font-size: 14px; line-height: 30px;text-indent: 6px;}
		.text_box_name{display: inline-block; height: 30px; text-align: right; color: #676a6c;width: 180px;margin-right: 20px; line-height: 30px;}
		.text_box_list>p{height: 20px; width: 180px;  margin-left: 200px;margin-top: 5px;line-height: 20px; font-size: 14px;display: none;}
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
			<h3>创建分组：</h3>
			<form>
				<div class="text_box_list">
					<span class="text_box_name">分组：</span><input type="text" class="input_title" placeholder="请输入分组"/>
					<p class="title_tips"></p>
				</div>
				<div class="text_box_list">
					<span class="text_box_name">分组中文名：</span><input type="text" class="input_title_name" placeholder="请输入分组中文名"/>
					<p class="title_name_tips"></p>
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
		var titleOff = false;
		var titleNameOff = false;
		$('.input_title').blur(function(){
			var title = $(this).val();
			if(title==''){
				$(this).addClass('error_border');
				$(".title_tips").text("请输入分组").addClass('error');
				$(".title_tips").parent().css('margin-bottom',"5px");
				titleOff = false;
			}else{
				$.post("<?php echo U('Admin/checkGroup');?>",{title:title},function(data){
					if(data.status=='0000'){
						$(".input_title").addClass('error_border');
						$(".title_tips").text(data.msg).addClass('error');
						$(".title_tips").parent().css('margin-bottom',"5px");
						titleOff = false;
					}else{
						$(".input_title").removeClass('error_border');
						$(".title_tips").text("").removeClass('error');
						$(".title_tips").parent().css('margin-bottom',"20px");
						titleOff = true;
					}
				})
			}
		})

		$('.input_title_name').blur(function(){
			var title_name = $(this).val();
			if(title_name==''){
				$(this).addClass('error_border');
				$(".title_name_tips").text("请输入分组名").addClass('error');
				$(".title_name_tips").parent().css('margin-bottom',"5px");
				titleNameOff = false;
			}else{
				$.post("<?php echo U('Admin/checkGroup');?>",{title_name:title_name},function(data){
					if(data.status=='0000'){
						$(".input_title_name").addClass('error_border');
						$(".title_name_tips").text(data.msg).addClass('error');
						$(".title_name_tips").parent().css('margin-bottom',"5px");
						titleNameOff = false;
					}else{
						$(".input_title_name").removeClass('error_border');
						$(".title_name_tips").text("").removeClass('error');
						$(".title_name_tips").parent().css('margin-bottom',"20px");
						titleNameOff = true;
					}
				})
			}
		})

		$("#submit").click(function(){
			var title = $(".input_title").val();
			var title_name = $(".input_title_name").val();
			var status = $("input:radio[name=status]:checked").val();
			if(!titleOff||!titleNameOff)return;
			$.post("<?php echo U('Admin/createGroup');?>",{title:title,title_name:title_name,status:status},function(data){
				if(data.status=='0000'){
					if(data.msg=='该分组已存在'||data.msg=="请输入分组"){
						$(".input_title").addClass('error_border');
						$(".title_tips").text(data.msg).addClass('error');
						$(".title_tips").parent().css('margin-bottom',"5px");
						titleOff = false;
					}else if(data.msg=='分组名已存在'||data.msg=="请输入分组名"){
						$(".input_title_name").addClass('error_border');
						$(".title_name_tips").text(data.msg).addClass('error');
						$(".title_name_tips").parent().css('margin-bottom',"5px");
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