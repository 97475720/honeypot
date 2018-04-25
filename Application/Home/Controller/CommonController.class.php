<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    /**
     * @var \Home\Model\UserModel
     */
    private $userModel;


    public function _initialize()
    {
        $this->userModel = D('user');
        $this->assign('user_nickname',$_SESSION['honeypot']['nickname']);
    }

}