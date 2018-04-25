<?php
namespace Home\Controller;
use Think\Controller;
class InformationController extends CommonController {
	
		public function userInformation($value='')
		{	
			$this->assign('user',$_SESSION['user']);
			$header = $this->fetch("header");
			$footer = $this->fetch("footer");
			$this->assign("header",$header);
			$this->assign("footer",$footer);
			$this->display();
		}


		public function saveInformation()
		{
			$this->assign('user',$_SESSION['user']);
			$header = $this->fetch("header");
			$footer = $this->fetch("footer");
			$this->assign("header",$header);
			$this->assign("footer",$footer);
			$this->display();
		}


		public function saveUser($value='')
		{
			$user_uid['uid']=$_POST['uid'];
			$map=array(
					"uname"=>$_POST["uname"],
					"unickname"=>$_POST["unickname"],
					"uphone"=>$_POST["uphone"],
					"uemail"=>$_POST["uemail"],
					"ubirthday"=>$_POST["ubirthday"],
					"usynopsis"=>$_POST["usynopsis"],
					"headpicture"=>$_POST["headpicture"],
				);
			$User = D("User");
			$res = $User->saveUser($user_uid,$map);
			if($res){
				$user = $User->searchUser($user_uid);
				$_SESSION["user"] = $user;
				return $this->ajaxReturn("1001","更新成功");
			}else{
				return $this->ajaxReturn("0000","用户资料修改遇到未知错误");
			}

		}



		public function headPictureUpload()
		{	
			$upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
			$upload->savePath  =      '';// 设置附件上传（子）目录
			$upload->subName  =  array(); //
			// 上传文件 
			$info   =   $upload->upload();
			$img="http://localhost/lplive/Uploads/".$info['photo']['savepath'].$info['photo']['savename'];
			if($info){
				$this->ajaxReturn("1001","上传成功",$img);
			}else{
				$this->ajaxReturn("000","头像更改失败");
			}

		}
}