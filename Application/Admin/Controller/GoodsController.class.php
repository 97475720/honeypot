<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends AuthController {

	public function grounding($value='')
	{
		$this->display();
	}



	public function goodsImgUpload()
	{	
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
			$upload->savePath  =      '';// 设置附件上传（子）目录
			$upload->subName  =  array(); //
			// 上传文件 
			$info   =   $upload->upload();
			$res = array();
			foreach ($info as $key => $value) {
				$img="http://localhost/lplive/Uploads/".$value['savepath'].$value['savename'];
				$res[]=$img;
			}
			if($info){
				$this->ajaxReturn("1001","上传成功",$res);
			}else{
				$this->ajaxReturn("000","上传失败");
			}

	}


	public function deleteFile($value='')
	{
		$imgSrc = $_POST['imgSrc'];
		$img = substr($imgSrc, 24);
		$res = unlink($img);
		if($res){
			$this->ajaxReturn("1001","删除成功");
		}else{
			$this->ajaxReturn("0000","移出失败");
		}
	}


	public function addGoods($value='')
	{
		$Goods = D("Goods");
		if(!$Goods->create()){
			return $this->ajaxReturn("0000",$Goods->getError());
		}else{
			$res = $Goods->add();
			if($res){
				return $this->ajaxReturn("1001","上传成功");
			}else{
				return $this->ajaxReturn("0000","上传失败");
			}

		}
	}

}	



	