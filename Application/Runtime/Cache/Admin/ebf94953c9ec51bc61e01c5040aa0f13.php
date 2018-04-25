<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		body,div,span,i,ul,li,h3{margin: 0; padding: 0;}
		li{list-style: none;}
		i{font-style: normal;cursor: pointer;}
		#index{width: 100%; height: 100%}
		#list_box{width: 80%; height: 750px; border:1px solid #1DA939; border-radius: 8px; margin: 30px auto 0px;box-sizing: border-box;}
		#list_box>h3{width: 100%; height: 50px; line-height: 50px; text-align: center; color: white;background: #1DA939; border-radius:0px 8px 0px  0px;
			border-bottom: 1px solid #ADC823;box-sizing: border-box;}
		#list_box>ul{width: 100%; height: 50px; text-align: center; line-height: 50px;}
		#list_box>.header_list{width: 100%; height: 50px;background-color: #fff; border-bottom: 1px solid #ddd;box-sizing: border-box;}
		#list_box>.header_list>.header_li{ color: #676A6C; font-weight: bold;  box-sizing:border-box;}
		#list_box>.content_list{width: 100%; height: 50px;}
		#list_box>.content_list>.content_li{width: 100%; height: 50px;background-color: #fff; border-bottom: 1px solid #ddd;box-sizing: border-box;}
		#list_box>ul>li>span{display: block;float: left; height: inherit; border-right:1px solid #ddd; box-sizing:border-box; font-family: "微软雅黑"}
		#list_box>ul>li>.group_num{width: 20%;}
		#list_box>ul>li>.group_name{width: 20%;}
		#list_box>ul>li>.group_createTime{width:20%;}
		#list_box>ul>li>.group_status{width: 10%;}
		#list_box>ul>li>.group_operate{width: 30%; border:none;}
		.group_status>div{width: 60px;height: 30px; border-radius: 30px; margin: 10px auto; position: relative;}
		.group_status>div>i{width: 30px; height: 30px; background: #fff; border-radius: 30px; position: absolute; transition: all 1s ease 0s; display: block;
			z-index: 10;}
		.status_right{background: #1DA939;position: relative;}
		.status_left{background: #ddd;position: relative;}
		.status_right>i{left: 31px;position: absolute;transition:all 0.5s ease 0s;}
		.status_left>i{left: -1px;position: absolute;transition:all 0.5s ease 0s;}
		.group_operate>i{background-color: #ddd;text-align: center;line-height: 30px; height: 30px; border-radius: 5px; color: #676A6C; font-family: "微软雅黑"; display: inline-block;}
		.group_delete{width: 50px;}
		.group_cig_rule{width: 100px;}
		#pop_up_box{width: 100%;height: 100%;background: #F3F3F4;opacity: 1; position: absolute; top: 0; left: 0;z-index: 10;display: none;}
		#pop_up_box>.pop_up{width: 800px; height: 600px; margin: 80px auto; opacity: 1; box-shadow: 0px 0px 10px 3px #ddd; border-radius: 8px;background: #fff; overflow: hidden; }
		.pop_up>h3{text-indent: 10px; margin-top: 20px; height: 50px; line-height: 50px; opacity: 1; }
		.all_rule_list{padding-left: 20px;  margin-top: 50px; width: 95%;height: 350px; text-align: left; min-height: 300px;}
		.rule_group{overflow: hidden;}
		.rule_group>span{display: block; width: 160px; height: 38px; text-align: center; line-height: 38px; background: #eee; border-radius: 6px; margin: 5px 8px;  cursor: pointer; float: left; color: #676A6C;}
		.operate_bar{width: 100%; text-align: center;}
		.operate_bar>span{display: inline-block; padding: 0 16px; height: 50px; background: #1DA939; color: white; font-weight: bold;line-height: 50px; margin: 50px 20px; border-radius: 6px; cursor: pointer;}
		.rule_group>.now_have{ background: #1AB394; color: white;}
		.rule_group>.now_mouseover{background: #DFF0D8}
	</style>
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
</head>
<body>
	<div id="index">
		<div id="list_box">
				<h3>分组列表</h3>
				<ul class="header_list">
					<li class="header_li">
						<span class="group_num">分组编号</span>
						<span class="group_name">分组名</span>
						<span class="group_createTime">创建时间</span>
						<span class="group_status">当前状态</span>
						<span class="group_operate">操作</span>
					</li>
				</ul>
				<ul class="content_list">
					<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="content_li">
						<span class="group_num" group_id="<?php echo ($vo["id"]); ?>"><?php echo ($vo["id"]); ?></span>
						<span class="group_name"><?php echo ($vo["title_name"]); ?></span>
						<span class="group_createTime"><?php echo ($vo["create_time"]); ?></span>
						<span class="group_status">
							<div class=<?php if($vo["status"] == 1): ?>"status_right"<?php else: ?>"status_left"<?php endif; ?>>
								<i class="group_status_button" status = "<?php echo ($vo["status"]); ?>" group_id = "<?php echo ($vo["id"]); ?>"></i>
							</div>
						</span>
						<span class="group_operate">
							<i class="group_delete" group_id = "<?php echo ($vo["id"]); ?>">删除</i>
							<i class="group_cig_rule" group_id = "<?php echo ($vo["id"]); ?>">配置权限</i>
						</span><?php endforeach; endif; else: echo "" ;endif; ?>
					
					</li>
				</ul>
		</div>
		<div id="pop_up_box">
			<!-- <div class="pop_up">
				<h3>所有规则：</h3>
				<div class="all_rule_list">
					<div class="rule_group">
						<p class="controller_name"></p>
						<span class="rule_name"></span>
					</div>
				</div>
				<div class="operate_bar">
					<span class="save_operate">保存</span><span class="exit_operate">退出</span>
				</div>
			</div> -->
		</div>
	</div>
	<script type="text/javascript">
			$(".group_delete").each(function(){
				$(this).click(function(){
					if(!confirm("是否删除此管理员，删除将无法恢复！"))return;
					var id = $(this).attr("group_id");
					$.post("<?php echo U('Admin/groupDelete');?>",{id:id},function(data){
						if(data.status=="1001"){
							window.location.reload();
						}else{
							alert(data.msg);
						}
					})
				})
			})

			$('.group_cig_rule').each(function(){
				$(this).click(function(){
					var id = $(this).attr('group_id');
					$('#pop_up_box').css('display','block');
					$.post("<?php echo U('Admin/readAllRule');?>",{id:id},function(data){
						if(data.status=='1001'){
							$('#pop_up_box').html(data.data);
						}else{
							alert(data.msg);
							window.location.reload();
						}
					})
				})
			})

			$('#pop_up_box').on('mouseover',".rule_name",function(){
					if(!$(this).hasClass("now_have")){
						$(this).addClass("now_mouseover");
					}
			})

			$('#pop_up_box').on('mouseout',".rule_name",function(){
					if($(this).hasClass("now_mouseover")){
						$(this).removeClass("now_mouseover");
					}
			})

			$('#pop_up_box').on('click',".rule_name",function(){
					if($(this).hasClass("now_have")){
						$(this).removeClass("now_have");
					}else{
						$(this).removeClass("now_mouseover");
						$(this).addClass("now_have");
					}
			})

			$('#pop_up_box').on('click',".exit_operate",function(){
					$('#pop_up_box').css('display','none');
			})

			$('#pop_up_box').on('click',".save_operate",function(){
					var group_id = $(this).attr('group_id');
					var rules_id = "";
					$.each($('.now_have'),function(k,v){
						rules_id+=$(v).attr('rule_id')+',';
					})
					rules_id = rules_id.substring(0,rules_id.length-1);
					$.post("<?php echo U('Admin/saveGroupRule');?>",{id:group_id,rules:rules_id},function(data){
						if(data.status=='1001'){
							alert(data.msg);
							window.location.reload();
						}else{
							alert(data.msg);
						}
					})
			})

			$('.group_status_button').each(function(){
				$(this).click(function(){
					var _this = $(this);
					var status = $(this).attr('status');
					var group_id = $(this).attr('group_id');
					if(status=='1'){
						$(this).attr('status',"0");
						status = $(this).attr('status');
					}else{
						$(this).attr('status',"1");
						status = $(this).attr('status');
					}
					$.post("<?php echo U('Admin/saveGroupStatus');?>",{group_id:group_id,status:status},function(data){
						if(data.status=="1001"){
							if(status=='1'){
								$(_this).parent().addClass('status_right').removeClass('status_left');
							}else{
								$(_this).parent().addClass('status_left').removeClass('status_right');
							}
						}else{
							alert(data.msg);
						}
					})
				})		
			})



			

	</script>
</body>
</html>