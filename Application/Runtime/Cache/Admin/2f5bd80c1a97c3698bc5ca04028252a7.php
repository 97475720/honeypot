<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
		body,div,span,i,ul,li,h3,p,i{margin: 0; padding: 0;font-family: "微软雅黑";}
		input{outline: none;}
		i{font-style: normal;cursor: pointer;}
		#index{margin: 50px 350px 0;color: #676A6C}
		.text_form{width: 100%; height: 100%;}
		.input_box{width: 100%;height: auto;margin-bottom: 30px;}
		.input_name{display: inline-block; width: 150px;text-align: right;height: 30px;line-height: 30px;}
		.input_box>input{display: inline-block;width: 1000px;border: 1px solid #ddd;height: 30px; line-height: 28px;  box-sizing:border-box;
						 text-indent: 10px;}
		.input_box>p{height: 20px;line-height: 20px;color: #bbb; margin-left: 161px;font-size: 12px;margin-top: 8px}
		.input_box>.goods_img_span{height: 30px;line-height: 30px;color: white; font-size: 14px; font-weight: bold; background: #1DA939;border-radius: 6px; padding: 0 10px; display: inline-block; cursor: pointer;}
		.input_box>.goods_synopsis_span{height: 30px;line-height: 30px;color: white; font-size: 14px; font-weight: bold; background: #1DA939;border-radius: 6px; padding: 0 10px; display: inline-block; cursor: pointer;}
		.input_box>div{width: 1000px;margin-left: 150px; height: auto; min-height: 100px; overflow: hidden;}
		.input_box>.goods_img_box>.img_box{width: 230px; height: 230px;margin: 10px 10px;float: left;position: relative;}
		.img_box>img{width: 230px; height: 230px;}
		.remove{width: 20px; height: 20px;background: #ddd; color:white;display: block; position: absolute; top: 0; right: 0;z-index: 10;text-align: center; line-height: 20px; opacity: 0.6;}
		.input_box>.goods_synopsis_box>.synopsis_box{width: 460px; height: 460px;margin: 20px 20px;float: left;position: relative;}
		.synopsis_box>img{width: 460px; height: 460px;}
		#goodsSubmit{color: white; background: #38A666; font-weight: bold; font-size: 16px; width: inherit; height: 40px; line-height: 40px; text-align: center;margin-bottom: 50px;}
	</style>
	<script type="text/javascript" src="/lplive/Public/JS/jquery-3.1.1.js"></script>
</head>
<body>

	<div id="index">
		<form class="text_from">
			<div class="input_box">
				<span class="input_name">商品名称：</span>
				<input type="text" placeholder="请输入商品名" class="goods_name">
			</div>
			<div class="input_box">
				<span class="input_name">最低价格：</span>
				<input type="text" placeholder="请输入商品最低价格" class="current_price">
			</div>
			<div class="input_box">
				<span class="input_name">商品分类：</span>
				<input type="text" placeholder="请输入商品分类" class="goods_class">
				<p class="tips">* 请以,隔开(例如：热门推荐,应季热销)</p>
			</div>
			<div class="input_box">
				<span class="input_name">商品原价：</span>
				<input type="text" placeholder="请输入商品原价" class="cost_price">
			</div>
			<div class="input_box">
				<span class="input_name">商品规格：</span>
				<input type="text" placeholder="请输入商品规格" class="goods_standard">
				<p class="tips">* 请严格按照格式(规格大小=价格,规格大小=价格)</p>
			</div>
			<div class="input_box">
				<span class="input_name">商品图片：</span>
				<span class="goods_img_span">点击上传</span>
				<div class="goods_img_box">
				</div>
			</div>
			<div class="input_box">
				<span class="input_name">商品详情：</span>
				<span class="goods_synopsis_span">点击上传</span>
				<div class="goods_synopsis_box"></div>
			</div>
		</form>
		<form class="img_form" enctype="multipart/form-data" style="display:none">
			<input type="file" name="img[]"  class="goods_img_upload" multiple="multiple">
		</form>
		<form class="synopsis_form" enctype="multipart/form-data" style="display:none">
			<input type="file" name="synopsis[]"  class="goods_synopsis_upload" multiple="multiple">
		</form>
		<div id="goodsSubmit">上传商品</div>
	</div>
	<script type="text/javascript">
		function deleteImg(imgSrc,_this,attr){
			$.post("<?php echo U('Goods/deleteFile');?>",{imgSrc:imgSrc},function(data){
					if(data.status=="1001"){
						$(_this).parent(attr).remove();
					}else{
						alert(data.msg);
					}
			})
		}


		$('.goods_img_box').on('mouseover',".goods_img",function(){
				$(this).siblings(".remove").css('opacity','1');
			}).on('mouseout',".goods_img",function(){
				$(this).siblings(".remove").css('opacity','0.6');
			}).on('mouseout',".remove",function(){
				$(this).css('opacity','0.6');
			}).on('mouseover',".remove",function(){
				$(this).css('opacity','1');
			}).on('click',".remove",function(){
				var imgsrc = $(this).siblings(".goods_img").attr("src");
				var this_ = $(this);
				deleteImg(imgsrc,this_,".img_box");	
			})


		$('.goods_synopsis_box').on('mouseover',".synopsis_img",function(){
				$(this).siblings(".remove").css('opacity','1');
			}).on('mouseout',".synopsis_img",function(){
				$(this).siblings(".remove").css('opacity','0.6');
			}).on('mouseout',".remove",function(){
				$(this).css('opacity','0.6');
			}).on('mouseover',".remove",function(){
				$(this).css('opacity','1');
			}).on('click',".remove",function(){
				var imgsrc = $(this).siblings(".synopsis_img").attr("src");
				var this_ = $(this);
				deleteImg(imgsrc,this_,".synopsis_box");	
			})


		
		$(".goods_img_span").click(function(){
			$(".goods_img_upload").click();
			$(document).ready(function(e){
				$(".goods_img_upload").change(function(e){
					 var imgFormData = new FormData($(".img_form")[0]);
					 $.ajax({
					 	  url: '<?php echo U("Goods/goodsImgUpload");?>' ,  
		                  type: 'POST',  
		                  data: imgFormData,  
		                  async: false,  
		                  cache: false,  
		                  contentType: false,  
		                  processData: false,  
		                  success: function (data) { 
		                  	if(data.status="1001"){
		                  		var img = "";
		                  		for (var i = 0; i <data.data.length; i++) {
		                  		    img +='<div class="img_box"><img class="goods_img" src="'+data.data[i]+'"><i class="remove">X</i></div>';
		                  		};
		                  		$(".goods_img_box").html(img);
		                  	}
		                  },  
		                  error: function (data) {  
		                      alert("未知错误"); 
		                  }  
					 });
				})
			})
		})

		$(".goods_synopsis_span").click(function(){
			$(".goods_synopsis_upload").click();
			$(document).ready(function(e){
				$(".goods_synopsis_upload").change(function(e){
					 var synopsisFormData = new FormData($(".synopsis_form")[0]);
					 $.ajax({
					 	  url: '<?php echo U("Goods/goodsImgUpload");?>' ,  
		                  type: 'POST',  
		                  data: synopsisFormData,  
		                  async: false,  
		                  cache: false,  
		                  contentType: false,  
		                  processData: false,  
		                  success: function (data) { 
		                  	if(data.status="1001"){
		                  		var synopsis = "";
		                  		for (var i = 0; i <data.data.length; i++) {
		                  		    synopsis +='<div class="synopsis_box"><img class="synopsis_img" src="'+data.data[i]+'"><i class="remove">X</i></div>';
		                  		};
		                  		$(".goods_synopsis_box").html(synopsis);
		                  	}
		                  },  
		                  error: function (data) {  
		                      alert("未知错误");
		                  }  
					 });
				})
			})
		})


		$("#goodsSubmit").click(function(){
			var goods_name = $(".goods_name").val();
			var current_price = $(".current_price").val();
			var goods_class = $(".goods_class").val();
			var cost_price = $(".cost_price").val();
			var goods_standard = $(".goods_standard").val();
			var goods_img = "";
			var goods_synopsis = "";
			$.each($(".goods_img"),function(k,v){
				goods_img+=$(v).attr('src')+',';
				
			})
			$.each($(".synopsis_img"),function(k,v){
				goods_synopsis+=$(v).attr("src")+",";
			})
			goods_img = goods_img.substr(0,goods_img.length-1);
			goods_synopsis = goods_synopsis.substr(0,goods_synopsis.length-1);
			$.post("<?php echo U('Goods/addGoods');?>",{goods_name:goods_name,current_price:current_price,goods_class:goods_class,cost_price:cost_price,goods_standard:goods_standard,goods_img:goods_img,goods_synopsis:goods_synopsis},function(data){
				if(data.status=="1001"){
					window.location.reload();
				}else{
					alert(data.msg);
				}
			})
		})

	</script>
</body>
</html>