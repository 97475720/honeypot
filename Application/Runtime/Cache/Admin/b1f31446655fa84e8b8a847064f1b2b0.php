<?php if (!defined('THINK_PATH')) exit();?>			<div class="pop_up">
				<h3>所有规则：</h3>
				<div class="all_rule_list">
				<?php if(is_array($res)): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="rule_group">
						<p class="controller_name"><?php echo ($key); ?>：</p>
						<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vl): $mod = ($i % 2 );++$i;?><span class="rule_name <?php echo ($vl["css_style"]); ?>" rule_id="<?php echo ($vl["rule_id"]); ?>"><?php echo ($vl["title"]); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
						
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
					
				</div>
				<div class="operate_bar">
					<span class="save_operate" group_id="<?php echo ($group_id); ?>">保存</span><span class="exit_operate">退出</span>
				</div>
			</div>