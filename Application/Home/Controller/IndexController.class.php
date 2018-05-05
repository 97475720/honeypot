<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    /**
     * @var \Home\Model\UserModel
     */
    private $userModel;
    /**
     * @var \Home\Model\CasesModel
     */
    private $casesModel;
    /**
     * @var \Home\Model\DraftImgModel
     */
    private $draftImgModel;
    /**
     * @var \Home\Model\CasesImageModel
     */
    private $casesImageModel;


    public function _initialize()
    {
        $this->userModel = D('user');
        $this->casesModel = D('cases');
        $this->draftImgModel = D('DraftImg');
        $this->casesImageModel = D('CasesImage');
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
            'expire'=>time(),
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
            'photo' => $user_info['photo'],
            'nickname'=> $user_info['nickname'],
            'token' => $user_info['token'],
        );
        $_SESSION['honeypot'] = $data;
        json();
    }

    /**
     * 用户信息
     */
    public function userInfo()
    {
        $user_id = $_SESSION['honeypot']['id'];
        $count = $this->casesModel
            ->where(['user_id'=> $user_id])
            ->count();
        $page = new \Think\Page($count, 23);
        $show = $page->show();
        $user_cases = $this->casesModel
            ->where(['user_id'=> $user_id])
            ->limit($page->firstRow,$page->listRows)
            ->select();
        $this->assign('cases',$user_cases);
        $this->assign('show',$show);
        $this->display();
    }
    
    /**
     * 搜索页
     */
    public function search()
    {
        $type = I('type',1);
        $key = I('key');
        if($key){
            $where['title'] = array('like',"%$key%");
        }else{
            $where['title'] = true;
        }
        if($type == 1){
            $order = "created_at desc";
        }elseif ($type == 2){
            $order = "collect_count desc";
        }
        $count = $this->casesModel
            ->where($where)
            ->count();
        $page = new \Think\Page($count, 24);// 实例化分页类 传入总记录数和每页显示的记录数
        $show = $page->show();// 分页显示输出
        $cases = $this->casesModel
            ->where($where)
            ->limit($page->firstRow,$page->listRows)
            ->order($order)
            ->select();
        $this->assign('cases',$cases);
        $this->assign('count',$count);
        $this->assign('show',$show);
        $this->display();
    }

    /**
     * 发布作品页面
     */
    public function releaseCases()
    {
        $this->display();
    }

    /**
     * 上传图片
     */
    public function casesImgUpload()
    {
        if(!$_FILES){
            json(110,"图片上传失败");
        }
        $img_info = uploadImg('cases');
        if($img_info === false){
            json(110,"图片上传失败");
        }
        $img_url = 'http://127.0.0.1/honeypot/Uploads/'.$img_info;
        $data = array(
            'user_id' => 1,
            'image_url' => $img_url,
        );
        if($this->draftImgModel->create($data,'addDraft') === false){
            unlink('./Uploads/'.$img_info);
            json(110,"图片上传失败");
        }
        $draft_id = $this->draftImgModel->add();
        if($draft_id === false){
            unlink('./Uploads/'.$img_info);
            json(110,"图片上传失败");
        }
        $result_data = array(
            'draft_id' => $draft_id,
            'image' => $img_url
        );
        json(200,'上传成功',$result_data);
    }

    /**
     * 发布作品
     * @param string title
     * @param string synopsis
     * @param string cover_img
     */
    public function publishCases()
    {
        $images = I('post.images');
        if(!$images){
            json(110,"请至少上传一张封面图");
        }
        $images = explode(',',$images);
        $_POST['cover_image'] = $images[0];
        $_POST['user_id'] = $images[0];
        $images = array_splice($images,1,1);
        $this->casesModel->startTrans();
        if($this->casesModel->create('','addCases') === false){
            $this->casesModel->rollback();
            json(110,$this->casesModel->getError());
        }
        $cases_id = $this->casesModel->add();
        if($cases_id === false){
            $this->casesModel->rollback();
            json(110,'作品上传失败，请重试');
        }
        if($images){
            foreach ($images as $k=>$v){
                $
            }
        }
    }

}