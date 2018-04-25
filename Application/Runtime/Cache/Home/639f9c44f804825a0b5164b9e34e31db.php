<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/lplive_index.css">
	<link rel="stylesheet" type="text/css" href="/lplive/Public/CSS/lplive_sign.css">
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="/lplive/Public/JS/index.js"></script>
</head>
<body>
	<div id="index">

 		<?php echo ($header); ?>
		
		<div id="user_information_box">
			
			<div id="user_information">
				
				<div class="head_picture">
					<img src="<?php if($user["headpicture"] != null): echo ($user["headpicture"]); else: ?>/lplive/Public/IMG/timg.jpg<?php endif; ?>" class="head_picture_img">
				</div>

				<form class="head_picture_form" enctype="multipart/form-data" method="post"  style="display:none">

						<input type="file" name="photo"  class="file_upload"  />
				</form>

				<form class="information_form">
					
					<div class="information_input_box">
						<span class="input_name">姓名</span>
						<input type="text" value="<?php echo ($user["uname"]); ?>" class="input_uname"/>
					</div>
					<div class="information_input_box">
						<span class="input_name">昵称</span>
						<input type="text" value="<?php echo ($user["unickname"]); ?>" class="input_unickname"/>
					</div>
					<div class="information_input_box">
						<span class="input_name">手机</span>
						<input type="text" value="<?php echo ($user["uphone"]); ?>" class="input_uphone"/>
					</div>
					<div class="information_input_box">
						<span class="input_name">邮箱</span>
						<input type="text" value="<?php echo ($user["uemail"]); ?>" class="input_uemail"/>
					</div>
					<div class="information_input_box">
						<span class="input_name">生日</span>
						<input type="text" value="<?php echo ($user["ubirthday"]); ?>" class="input_ubirthday" />
					</div>
					<div class="information_input_synopsis">
						<span class="input_name">简介</span>
						<textarea class="input_usynopsis" ><?php echo ($user["usynopsis"]); ?></textarea>
					</div>

				</form>
				<div id="save_submit" uid="<?php echo ($user["uid"]); ?>">保存修改</div>
				
			</div>
				
			
		</div>



	<?php echo ($footer); ?>

	</div>

</body>
</html>