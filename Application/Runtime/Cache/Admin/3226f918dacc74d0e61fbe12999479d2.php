<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		body,div,span,i,ul,li,h3{margin: 0; padding: 0; font-family: "微软雅黑"}
		li{list-style: none;}
		i{font-style: normal;cursor: pointer;}
		body{width: 100%;height: 100%;}
		#index{width: 100%; height: 100%;position: relative;}
		#index>#list_box{width: 90%; height: 710px; border:1px solid #1DA939; border-radius: 8px; margin: 0 auto ;box-sizing: border-box;margin-top: 30px; z-index: 2}
		#list_box>h3{width: 100%; height: 50px; line-height: 50px; text-align: center; color: white;background: #1DA939; border-radius:8px 8px 0px  0px;
			border-bottom: 1px solid #ADC823;box-sizing: border-box;}
		#list_box>ul{width: 100%; height: 50px; text-align: center; line-height: 50px;z-index: 1}
		#list_box>.header_list{width: 100%; height: 50px;background-color: #fff; border-bottom: 1px solid #ddd;box-sizing: border-box;}
		#list_box>.header_list>.header_li{ color: #676A6C; font-weight: bold;  box-sizing:border-box;}
		#list_box>.content_list{width: 100%; height: 50px;}
		#list_box>.content_list>.content_li{width: 100%; height: 50px;background-color: #fff; border-bottom: 1px solid #ddd;box-sizing: border-box;}
		#list_box>ul>li>span{display: block;float: left; height: inherit; border-right:1px solid #ddd; box-sizing:border-box;}
		#list_box>ul>li>.admin_num{width: 20%;}
		#list_box>ul>li>.admin_name{width: 10%;}
		#list_box>ul>li>.admin_group{width: 15%;}
		#list_box>ul>li>.admin_phone{width: 10%;}
		#list_box>ul>li>.admin_email{width: 20%;}
		#list_box>ul>li>.admin_status{width: 10%;}
		#list_box>ul>li>.admin_operate{width: 15%; border:none;}
		.admin_status>div{width: 60px;height: 30px; border-radius: 30px; margin: 10px auto; position: relative;}
		.status_right{background: #1DA939;}
		.status_left{background: #ddd;}
		.status_right>i{left: 31px;width: 30px; height: 30px; background: #fff; border-radius: 30px; position: absolute;  display: block;transition:left 1s ease 0s;}
		.status_left>i{left: -1px;width: 30px; height: 30px; background: #fff; border-radius: 30px; position: absolute;  display: block;transition:left 1s ease 0s;}
		.admin_operate>i{background-color: #ddd;text-align: center;line-height: 30px; height: 30px; border-radius: 5px; color: #676A6C; font-family: "微软雅黑"; display: inline-block;}
		.admin_delete{width: 50px;}
		.admin_cig_rule{width: 100px;}
		#pop_up_box{width: 100%;height: 100%;background: #F3F3F4;opacity: 1; position: absolute; top: 0; left: 0;z-index: 10;display: none;}
		#pop_up_box>.pop_up{width: 800px; height: 600px; margin: 80px auto; opacity: 1; box-shadow: 0px 0px 10px 3px #ddd; border-radius: 8px;background: #fff; overflow: hidden; }
		.pop_up>h3{text-indent: 10px; margin-top: 20px; height: 50px; line-height: 50px; opacity: 1; }
		.all_group_list{padding-left: 20px;  margin-top: 50px; width: 95%;height: 350px; text-align: left;}
		.all_group_list>span{display: block; width: 160px; height: 38px; text-align: center; line-height: 38px; background: #eee; border-radius: 6px; margin: 5px 8px;  cursor: pointer; float: left; color: #676A6C;}
		.operate_bar{width: 100%; text-align: center;}
		.operate_bar>span{display: inline-block; padding: 0 16px; height: 50px; background: #1DA939; color: white; font-weight: bold;line-height: 50px; margin: 50px 20px; border-radius: 6px; cursor: pointer;}
		.all_group_list>.now_have{ background: #1AB394; color: white;}
		.all_group_list>.now_mouseover{background: #DFF0D8}
		.page_box{width: 100%; height: 50px; color: #676A6C;text-align: center;line-height: 50px;font-size: 18px;	margin-top: 10px; }
	</style>
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
</head>
<body>
	<div id="index">
		<div id="list_box">
				<h3>管理员列表</h3>
				<ul class="header_list">
					<li class="header_li">
						<span class="admin_num">编号</span>
						<span class="admin_name">姓名</span>
						<span class="admin_group">最近登录时间</span>
						<span class="admin_phone">电话</span>
						<span class="admin_email">邮箱</span>
						<span class="admin_status">状态</span>
						<span class="admin_operate">操作</span>
					</li>
				</ul>

				<ul class="content_list">
					<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="content_li">
						<span class="admin_num"><?php echo ($vo["uid"]); ?></span>
						<span class="admin_name"><?php echo ($vo["uname"]); ?></span>
						<span class="admin_group"><?php echo ($vo["group_name"]); ?></span>
						<span class="admin_phone"><?php echo ($vo["uphone"]); ?></span>
						<span class="admin_email"><?php echo ($vo["uemail"]); ?></span>
						<span class="admin_status">
							<div class=<?php if($vo["ustatus"] == 1): ?>"status_right"<?php else: ?>"status_left"<?php endif; ?>>
								<i class="admin_status_button" admin_id="<?php echo ($vo["uid"]); ?>" admin_status="<?php echo ($vo["ustatus"]); ?>"></i>
							</div>
						</span>
						<span class="admin_operate">
							<i class="admin_delete" admin_id="<?php echo ($vo["uid"]); ?>">删除</i>
							<i class="admin_cig_group"  admin_id="<?php echo ($vo["uid"]); ?>">更换分组</i>
						</span>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>		
				</ul>
				
		</div>
		<div class = "page_box"><?php echo ($page); ?></div>
		<div id="pop_up_box">
			<!-- <div class="pop_up">
				<h3>所有分组：</h3>
				<div class="all_group_list">
					<span class="group_name">超级管理员</span>
				</div>
				<div class="operate_bar">
					<span class="save_operate">保存</span><span class="exit_operate">退出</span>
				</div>
			</div> -->
		</div>
	</div>
	

	<script>

		$('.admin_status_button').each(function(){
			$(this).click(function(){
				var _this = $(this);
				var uid = $(this).attr('admin_id');
				var ustatus = $(this).attr('admin_status');
				
				if(ustatus=='0'){
					 $(this).attr('admin_status','1');
					 ustatus = $(this).attr('admin_status');
				}else{
					 $(this).attr('admin_status','0');
					 ustatus = $(this).attr('admin_status');
				}
				$.post("http://localhost/lplive/index.php/Admin/Admin/saveAdminStatus",{uid:uid,ustatus:ustatus},function(data){
					if(data.status=='1001'&&data.data=='1'){
						$(_this).parent().addClass('status_right').removeClass('status_left');
					}else if(data.status=='1001'&&data.data=='0'){
						$(_this).parent().addClass('status_left').removeClass('status_right');
					}else{
						alert(data.msg);
					}
				})
			})
		})


		$('.admin_delete').each(function(){
			$(this).click(function(){
				if(!confirm("是否删除此管理员，删除将无法恢复！"))return;
				var uid = $(this).attr('admin_id');
				$.post("<?php echo U('Admin/deleteAdmin');?>",{uid:uid},function(data){
					if(data.status=='1001'){
						window.location.reload();
					}else{
						alert(data.msg);
					}
				})
			})
		})

		$('.admin_cig_group').each(function(){
			$(this).click(function(){
				var uid = $(this).attr('admin_id');
				$('#pop_up_box').css('display','block');
				$.post("<?php echo U('Admin/allGroupList');?>",{uid:uid},function(data){
					if(data.status=='1001'){
						$('#pop_up_box').html(data.data);
					}else{
						alert(data.msg);
					}
				})
			})
		})

		$('#pop_up_box').on('mouseover','.group_name',function(){

			if(!$(this).hasClass('now_have')){
				$(this).addClass('now_mouseover');
			}

		})
		$('#pop_up_box').on('mouseout','.group_name',function(){
					$(this).removeClass('now_mouseover');
		})
		$('#pop_up_box').on('click','.group_name',function(){
			$(this).removeClass('now_mouseover');
			$(this).addClass('now_have');
			$(this).siblings().removeClass('now_have');

		})
		$('#pop_up_box').on('click','.exit_operate',function(){
					$('#pop_up_box').css('display','none');
		})
		$('#pop_up_box').on('click','.save_operate',function(){
					var uid = $(this).attr('admin_id');
					var id = $('.now_have').attr('group_id');
					$.post("<?php echo U('Admin/saveAdminGroup');?>",{uid:uid,id:id},function(data){
						if(data.status=='1001'){
							alert(data.msg);
							window.location.reload();
						}else{
							alert(data.msg);
						}
					})
		})

	</script>

</body>
</html>