<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-22
	 * @参数:
	 * @方法描述:
	 */
	public function admin()
	{
		$this->display();
	}


	public function code_rule($value='')
	{
		$this->display();
	}

	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-22
	 * @参数:
	 * @方法描述:
	 * @return   [type]
	 */
	public function create_group()
	{
		$this->display();
	}


	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-22
	 * @参数:
	 * @方法描述:
	 * @return   [type]
	 */
	public function create_admin()
	{

		$group = D("Authgroup");
		$res = $group->allGroup("id,title_name");
		$this->assign('res',$res);
		$this->display();
	}
	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-25
	 * @参数:
	 * @方法描述:  创建管理员对字段的验证
	 * @param    string     $value [description]
	 * @return   [type]            [description]
	 */
	public function check($value='')
	{
		$admin = D('Adminuser');
		if(!$admin->create()){
			return $this->ajaxReturn('0000',$admin->getError());
		}else{
			return $this->ajaxReturn('1001','');
		}
	}



	public function createAdmin($value='')
	{
		$admin = D("Adminuser");
		$Groupaccess = D('Groupaccess');
		$adminUser = $admin->create();
		$accessCreate = array(
				'group_id'=>$_POST['group_id'],
				'uid'=>$adminUser['uid'],
			);
		if(!$adminUser){
			return $this->ajaxReturn('0000',$admin->getError());
		}else{
			$res = $admin->add();
			if($res){
				$map = M('auth_group_access')->add($accessCreate);
				if ($map) {
					  return $this->ajaxReturn('1001','管理员创建成功');
					}else{
						$admin->deleteAdmin($adminUser['uid']);
						return $this->ajaxReturn('1001','管理员创建失败');
					}	
			}else{
				return $this->ajaxReturn('0000','管理员创建失败');
			}

		}
	}


	public function createRule($value='')
	{
		$Authrule = D('Authrule');
		if(!$Authrule->create()){
			return $this->ajaxReturn('0000',$Authrule->getError());
		}else{
			$Authrule->add();
			return $this->ajaxReturn('1001','验证规则创建成功');
		}
	}

	public function checkRule($value='')
	{
		$Authrule = D('Authrule');
		if(!$Authrule->create()){
			return $this->ajaxReturn('0000',$Authrule->getError());
		}else{
			return $this->ajaxReturn('1001','');
		}
	}


	public function createGroup($value='')
	{
		$Authgroup = D('Authgroup');
		if(!$Authgroup->create()){
			return $this->ajaxReturn('0000',$Authgroup->getError());
		}else{
			$Authgroup->add();
			return $this->ajaxReturn('1001','分组创建成功');
		}
	}


	public function checkGroup($value='')
	{
		$Authgroup = D("Authgroup");
		if(!$Authgroup->create()){
			return $this->ajaxReturn("0000",$Authgroup->getError());
		}else{
			return $this->ajaxReturn("1001","");
		}
	}
	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-22
	 * @参数:
	 * @方法描述:  读取分组列表
	 * @return   [type]
	 */
	public function group_list()
	{
		$res = M('auth_group')->order("create_time asc")->select();
		$this->assign('res',$res);
		$this->display();
	}

	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-22
	 * @参数:
	 * @方法描述: 获取管理员所有数据
	 * @return   [type]
	 */
	public function admin_list()
	{	
		$maxPage = 12;
		$Adminuser = D("Adminuser");
		$Groupaccess = D("Groupaccess");
		$groupList = $Groupaccess->joinSearch();
		$count = D("Adminuser")->countNum();
		$Page = new \Think\Page($count,$maxPage);
		$show = $Page->show();
		$list = $Adminuser->limit($Page->firstRow.','.$Page->listRows)->select();
		$map = array();
		foreach ($list as $key => $value) {
			$res = judgeGroup($groupList,$value['uid']);
			$value = array(
					"uid"=>$value['uid'],
					"uname"=>$value['uname'],
					"group_name"=>$res,
					"uphone"=>$value['uphone'],
					"uemail"=>$value['uemail'],
					"ustatus"=>$value['ustatus'],
				);
			$map[] = $value;
		}

		$this->assign('list',$map);
		$this->assign('page',$show);
		$this->display();
	}

	// public function test($value='')
	// {
	// 	$res = M("auth_group_access")->join("think_auth_group on think_auth_group.id = think_auth_group_access.group_id")
	// 								 ->select();
	// 								 dump($res);
	// }


	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-24
	 * @参数:     uid:string   ustatus:string
	 * @方法描述:	更改管理员状态
	 * @return   [type]     [description]
	 */
	public function saveAdminStatus()
	{
		$admin_id['uid']=$_POST['uid'];
		$admin_status['ustatus']=$_POST['ustatus'];
		$res = M('admin_user')->where($admin_id)->save($admin_status);
		if($res){
			return $this->ajaxReturn("1001","管理员状态已更新成功",$admin_status['ustatus']);
		}else{
			return $this->ajaxReturn('0000','管理员状态更新失败');
		}
	}

	public function saveGroupStatus($value='')
	{
		$group_id['id'] = $_POST['group_id'];
		$status['status'] = $_POST['status'];
		$Authgroup = D("Authgroup");
		$res = $Authgroup->saveStatus($group_id,$status);
		if($res){
			return $this->ajaxReturn("1001","更新成功");
		}else{
			return $this->ajaxReturn("0000","更新失败");
		}
	}

	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-24
	 * @参数:	uid:string
	 * @方法描述: 删除管理员方法
	 * @return   [type]     [description]
	 */
	public function deleteAdmin()
	{
		$admin_id['uid'] = $_POST['uid'];
		$Adminuser = D('Adminuser');
		$Groupaccess = D("Groupaccess");
		$res = $Adminuser->deleteAdmin($admin_id);
		if($res){
			if($Groupaccess->accessDelete($admin_id)){
				return $this->ajaxReturn('1001','管理员已删除！');
			}else{
				return $this->ajaxReturn('0000','管理员删除失败！');
			}			
		}else{
			return $this->ajaxReturn('0000','管理员删除失败！');
		}
	}


	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-24
	 * @参数:	uid:string（管理员ID）
	 * @方法描述:	获取到所有分组
	 * @param    string     $value [description]
	 * @return   [type]            [description]
	 */
  	public function allGroupList($value='')
  	{
  		$admin_id['uid'] = $_POST['uid'];
  		$group_id =M('auth_group_access')->where($admin_id)->find();
  		$res = M("auth_group")->select();
  		$map = array();
  		foreach ($res as $key => $value) {
  			if(in_array($value['id'],$group_id)){
  					$value = array(
  							'id'=>$value['id'],
  							'title_name'=>$value['title_name'],
  							'css_style'=>"now_have",
  						);
  					$map[]=$value;
  			}else{
  					$value = array(
  							'id'=>$value['id'],
  							'title_name'=>$value['title_name'],
  							'css_style'=>"",
  						);
  					$map[]=$value;
  			}
  		}
  		$this->assign('map',$map);
  		$this->assign('admin_id',$admin_id['uid']);
  		$html = $this->fetch();
  		if($res){
  			return $this->ajaxReturn("1001","",$html);
  		}else{
  			return $this->ajaxReturn("0000","异常错误");
  		}

  	}

  	/**
  	 * @Author   Hybrid
  	 * @DateTime 2017-07-24
  	 * @参数:	uid:string(管理员ID)  id:string(组ID)
  	 * @方法描述: 更改管理员分组
  	 * @return   [type]     [description]
  	 */
	public function saveAdminGroup()
	{
		$admin_id['uid'] = $_POST['uid'];
		$group_id['group_id'] = $_POST['id'];
		$res = M('auth_group_access')->where($admin_id)->save($group_id);
		if($res){
			return $this->ajaxReturn('1001','管理员分组更改成功');
		}else{
			return $this->ajaxReturn('1001','管理员分组更改出现异常错误');
		}
	}



	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-25
	 * @参数:
	 * @方法描述:删除分组操作
	 * @param    string     $value [description]
	 * @return   [type]            [description]
	 */
	public function groupDelete($value='')
	{
		$group_id['id'] = $_POST['id'];
		$Authgroup = D('Authgroup');
		$Groupaccess = D('Groupaccess');
		if($Authgroup->DeleteGroup($group_id)){		
				return $this->ajaxReturn('1001','分组删除成功');		
		}else{
				return $this->ajaxReturn('0000','分组删除失败');
		}
			
	}


	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-26
	 * @参数:	id：string(组ID)
	 * @方法描述:获取到所有规则并渲染
	 * @param    string     $value [description]
	 * @return   [type]            [description]
	 */
	public function readAllRule($value='')
	{
		$group_id['id'] = I('id');
		$auth_group = D("Authgroup");
		$auth_rule = D('Authrule');
		$group_rule = $auth_group->nowGroup($group_id);
		$rule = D('Authrule')->allRules();
		$group_rules = explode(',',$group_rule['rules']);
		foreach ($rule as $key => $value) {
			if(in_array($value['id'], $group_rules)){
				$res[$value['controller_name']][]=	array(
														'rule_id'=>$value['id'],
														'title'=>$value['title'],
														"css_style"=>'now_have',
														);
			}else{
				$res[$value['controller_name']][]=	array(
														'rule_id'=>$value['id'],
														'title'=>$value['title'],
														"css_style"=>'',
														);
			}
		}
		$this->assign('res',$res);
		$this->assign('group_id',$group_id['id']);
		$html = $this->fetch();
		if($rule){
			return $this->ajaxReturn("1001","",$html);
		}else{
			return $this->ajaxReturn("0000","规则获取异常");
		}
	}


	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-27
	 * @参数:	id:string(当前分组ID)    rules:string(分组配置规则ID，多个用,隔开)
	 * @方法描述:分组权限配置
	 * @param    string     $value [description]
	 * @return   [type]            [description]
	 */
	public function saveGroupRule($value='')
	{
		$Authgroup = D('Authgroup');
		$group_id['id']=I('id');
		$rules['rules'] = I('rules');
		$res = $Authgroup->saveRules($group_id,$rules);
		if($res){
			return $this->ajaxReturn('1001',"权限配置成功");
		}else{
			return $this->ajaxReturn('0000',"权限配置出现未知错误");
		}
	

	}


	public function loginOut($value='')
	{
		$_SESSION['admin']="";
		if($_SESSION['admin']){
			return $this->ajaxReturn('0000',"用户注销失败");
		}else{
			return $this->ajaxReturn("1001","退出成功");
		}
	}

	public function bbb($value='')
	{
		$res = M()->query('SELECT `controller_name` FROM `think_auth_rule` GROUP BY `controller`');
		dump($res);
	}


	public function test($value='')
	{
		$res = M("auth_rule")->field("name")->group("controller_name")->select();
		dump($res);
	}



}