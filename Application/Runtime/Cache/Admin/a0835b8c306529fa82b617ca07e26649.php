<?php if (!defined('THINK_PATH')) exit();?><div class="pop_up">
				<h3>所有分组：</h3>
				<div class="all_group_list">
					<?php if(is_array($map)): $i = 0; $__LIST__ = $map;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><span class="group_name <?php echo ($vo["css_style"]); ?>" group_id="<?php echo ($vo["id"]); ?>"><?php echo ($vo["title_name"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
					
				</div>
				<div class="operate_bar">
					<span class="save_operate" admin_id="<?php echo ($admin_id); ?>">保存</span><span class="exit_operate">退出</span>
				</div>
</div>