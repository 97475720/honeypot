<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {


	public function login($value='')
	{	
		$this->display();
	}

	public function sign($value='')
	{	
		$this->display();
	}


	function loginUser()
    {
    	$User = D("User");
    	$this->checkCode($_POST['code']);
    	$user_num['uphone'] = $_POST['unum'];
        $user_num['uemail'] = $_POST['unum'];
    	$user_num['_logic'] = "OR";
    	$upwd = $_POST['upwd'];
    	$res = $User->searchUser($user_num);
    	if($res){
    		if($res['ustatus']=='0'){
    			return $this->ajaxReturn("0000","该用户已被冻结");
    		}else if($res['upwd']==filt($upwd)){
    			$dateTime['logintime'] = date('Y-m-d H:i:s',time());
    			$User->saveUser(array('uid'=>$res['uid']),$dateTime);
    			$map = $User->searchUser(array('uid'=>$res['uid']));
    			$userInformation = array(
                        "uid"=>$map['uid'],
    					"uname"=>$map['uname'],
    					"unickname"=>$map['unickname'],
    					"uphone"=>$map['uphone'],
    					"uemail"=>$map['uemail'],
    					"signtime"=>$map['signtime'],
    					"logintime"=>$map['logintime'],
    					"headpicture"=>$map['headpicture'],
    					"ubirthday"=>$map['ubirthday'],
    					"usynopsis"=>$map['usynopsis'],
    				);
    			$_SESSION['user'] = $userInformation;
    			return $this->ajaxReturn("1001","登陆成功",$userInformation);
    		}else{
    			return $this->ajaxReturn("0000","账号不存在或密码错误");
    		}
    	}else{
    		return $this->ajaxReturn("0000","账号不存在或密码错误");
    	}
    }


     public function signUser($value='')
    {
    	$this->checkCode($_POST['code']);
    	$User = D('User');
        $map = $User->create();
    	if(!$map){
    		return $this->ajaxReturn("0000",$User->getError());
    	}else{
    		$res = $User->add();
    		if ($res) {
                $dateTime['logintime'] = date('Y-m-d H:i:s',time());
                $User->saveUser(array('uid'=>$res['uid']),$dateTime);
                $userInformation = array(
                        "uid"=>$map['uid'],
                        "uname"=>$map['uname'],
                        "unickname"=>$map['unickname'],
                        "uphone"=>$map['uphone'],
                        "uemail"=>$map['uemail'],
                        "signtime"=>$map['signtime'],
                        "logintime"=>$map['logintime'],
                        "headpicture"=>$map['headpicture'],
                        "ubirthday"=>$map['ubirthday'],
                        "usynopsis"=>$map['usynopsis'],
                    );
                $_SESSION['user'] = $userInformation;
    			return $this->ajaxReturn("1001","");
    		}else{
    			return $this->ajaxReturn("1001","注册失败");
    		}
    	}
    }



    /**
     * @Author   Hybrid
     * @DateTime 2017-07-31
     * @参数:
     * @方法描述:注册验证字段
     * @return   [type]     [description]
     */
    public function check()
    {
    	$User = D('User');
    	if(!$User->create()){
    		$this->ajaxReturn("0000",$User->getError());
    	}else{
    		$this->ajaxReturn("1001","");
    	}
    }




     /**
     * @Author   Hybrid
     * @DateTime 2017-07-31
     * @参数:   code:string
     * @方法描述:验证码验证
     * @param    string     $value [description]
     * @return   [type]            [description]
     */
    public function checkCode($value='')
    {
    	$code = $value?$value:$_POST['code'];
    	if(!$value){
    		if(checkVerify($_POST['code'])){
    			return $this->ajaxReturn("1001","");
    		}else{
    			return $this->ajaxReturn("0000","验证码错误");
    		}
    	}else{
    		if(checkVerify($value)){
    			return true;
    		}else{
    			return $this->ajaxReturn("0000","验证码错误");
    		}
    	}
    }





}