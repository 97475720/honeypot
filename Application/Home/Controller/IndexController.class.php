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
    
    public function goods($value='')
    {
        $goods_id["id"] = $_GET['id'];
        $res = M("goods")->where($goods_id)->find();
        $img = explode(",", $res["goods_img"]);
        $synopsis = explode(",", $res["goods_synopsis"]);
        $standard = explode(",", $res["goods_standard"]);
        foreach ($standard as $key => &$value) {
            $value = explode("=", $value);
        }
        $this->assign("goods",$res);
        $this->assign("img",$img);
        $this->assign("synopsis",$synopsis);
        $this->assign("standard",$standard);
        $this->display();

    }
    

    public function cancel($value='')
    {
        $_SESSION["user"] = "";
        if ($_SESSION["user"]) {
            return $this->ajaxReturn("0000","退出异常");
        }else{
            return $this->ajaxReturn("1001","用户已注销");
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

   

    public function searchGoods($value='')
    {
        $Maxpage = 20;
        $goodName = $_GET['name'];
        if (S($goodName)) {
            $Goods = D("Goods");
            $name['goods_name'] = array("like","%$goodName%"); 
            $count = S($goodName."_num");
            $Page       = new \Think\Page($count,$Maxpage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();// 分页显示输出
        }
        $Goods = D("Goods");
        $name['goods_name'] = array("like","%$goodName%"); 
        $count = $Goods->where($name)->count();// 查询满足要求的总记录数
        S($goodName."_num",$count);
        $Page       = new \Think\Page($count,$Maxpage);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出

        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $Goods->where($name)->limit($Page->firstRow.','.$Page->listRows)->select();
        S($goodName,$list);
        foreach ($list as $key =>&$value) {
           $value["goods_img"] =   explode(",", $value['goods_img']);
        }
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->assign('count',$count);
        $this->assign('goodName',$goodName);
        $this->display(); // 输出模板
    }


}