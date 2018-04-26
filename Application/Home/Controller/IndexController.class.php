<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    /**
     * @var \Home\Model\UserModel
     */
    private $userModel;


    public function _initialize()
    {
        $this->userModel = D('user');
        $this->assign('user_nickname',$_SESSION['honeypot']['nickname']);
    }


    public function index()
    {
        $this->display();
    }

    /**
     * 登录
     * @param string username
     * @param string password
     */
    public function login()
    {
        $username = I('post.username');
        $password = I('post.password');
        $user_info = $this->userModel
            ->where(['username'=>$username])
            ->find();
        if(!$user_info || md5($password.$user_info['salt']) != $user_info['password']){
            json(110,'用户名不存在或密码错误');
        }
        $token = time();
        if($this->userModel->where(['username'=>$username])->setField('token',$token) === false){
            json(110,'网络错误，登录失败！');
        }
        $_SESSION['honeypot'] = array(
            'id' => $user_info['id'],
            'nickname'=> $user_info['nickname'],
            'token' => $token,
        );
        json();

    }

    /**
     * 退出登录
     */
    public function loginOut()
    {
        $_SESSION['honeypot'] = "";
        if($_SESSION['honeypot']){
            json(110,"网络错误，注销失败");
        }else{
            json();
        }

    }


    /**
     *注册前的验证
     */
    public function registerVerify()
    {
        if($this->userModel->create('','registerVerify') === false){
            json(110,$this->userModel->getError());
        }
        json();
    }
    /**
     * 注册新用户
     */
    public function sign()
    {
        $user_info = $this->userModel->create('','register');
        if($user_info === false){
            json(110,$this->userModel->getError());
        }
        $user_id = $this->userModel->registerNewUser();
        if($user_id === false){
            json(110,$this->userModel->getError());
        }
        $data = array(
            'id' => $user_id,
            'nickname'=> $user_info['nickname'],
            'token' => $user_info['token'],
        );
        $_SESSION['honeypot'] = $data;
        json();
    }


}