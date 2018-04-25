<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Auth;
class AuthController extends Controller 
{
   // public function _initialize()
   // {
   // 		$auth = new Auth();
   // 		if(!$_SESSION['user']){
   // 			// $this->notauth('123');	
   // 		}elseif($_SESSION['user']['group_id']=='1'){

   // 		}elseif(in_array($_SESSION['user']['uname'],C("ALLOWVIEW")) ){
   // 			return ture;
   // 		}elseif(in_array(CONTROLLER_NAME."/".ACTION_NAME,C("ALLOWMEDTH")) ){
			// return ture;
   // 		}elseif($auth->check(MODULE_NAME."/".CONTROLLER_NAME."/".ACTION_NAME,$_SESSION['user']["uid"])){
   // 			$this->notauth('您当前没有权限访问!');
   // 		}
   // }


   // public function notAuth($msg,$url='Auth/auth',$time='3')
   // {
   // 		$this->assign('url',$url);
   // 		$this->assign('msg',$msg);
   // 		$this->assign('time',$time);
   // 		die($this->display('Auth/notauth'));
   // }
   

	public function _initialize($value='')
	{  
      
      $this->assign("admin",$_SESSION["admin"]);
		$auth=new Auth();
		if(!$_SESSION['admin']){
			 redirect('http://localhost/lplive/index.html/Admin/Login/admin_login');
		}else if($_SESSION['admin']['group_id']==C("SUPERADMIN")){
         return true;
      }else if (in_array(CONTROLLER_NAME."/".ACTION_NAME, C("ALLOWMEDTH"))) {
         return true;
      }else if(!$auth->check(MODULE_NAME."/".CONTROLLER_NAME."/".ACTION_NAME,$_SESSION['admin']["uid"])){
         $this->noAuth();
         
      }
	}

   public function noAuth($value='')
   {
      die($this->display("Auth/noAuth"));
   }



}