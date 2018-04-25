<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function admin_login(){
  		$this->display();
    }

    public function login($value='')
    {
    	$admin = D("Adminuser");
    	$admin_num['uphone'] = $_POST['num'];
    	$admin_num['uemail'] = $_POST['num'];
    	$admin_num['_logic'] = "OR";
    	$upwd = $_POST['upwd'];
    	$res = $admin->searchAdmin($admin_num);
    	if($res){
			if($res['ustatus'==0]){
    			return $this->ajaxReturn("0000","此账户已被冻结");
    		}else if($res['upwd']==filt($upwd)){
    			$dateTime['ulogin_date'] = date('Y-m-d H:i:s',time());
    			$admin->saveAdmin($admin_num,$dateTime);
    			$adminUser = $admin->joinSelect(array("think_admin_user.uid"=>$res['uid']));
    			foreach ($adminUser as $key => $value) {
    				$adminuser =$value;
    			}
    			$_SESSION=array(
    				"admin"=>$adminuser,
    				);
    			return $this->ajaxReturn("1001","登录成功");
    		}else{
    			return $this->ajaxReturn("0000","账号或密码错误");
    		}
    	}else{
    		return $this->ajaxReturn("0000","账号或密码错误");
    	}

    }
}