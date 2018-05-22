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
    /**
     * @var \Home\Model\CasesCommentModel
     */
    private $casesCommentModel;
    /**
     * @var \Home\Model\CollectModel
     */
    private $collectModel;


    public function _initialize()
    {
        $this->userModel = D('user');
        $this->casesModel = D('cases');
        $this->draftImgModel = D('DraftImg');
        $this->casesCommentModel = D('CasesComment');
        $this->casesImageModel = D('CasesImage');
        $this->collectModel = D('Collect');
        $this->assign('user_nickname',$_SESSION['honeypot']['nickname']);
        $this->assign('user_photo',$_SESSION['honeypot']['photo']);
    }


    public function index()
    {
        $colors = array(
            "#fe2323",
            "#2d23fe",
            "#fe23fb",
        );
        $hot_cases = $this->casesModel
            ->join('user AS u on u.id = c.user_id')
            ->field('c.id,c.title,c.cover_img,c.collect_count,u.nickname')
            ->limit(10)
            ->alias('c')
            ->order('collect_count desc')
            ->select();
        foreach ($hot_cases as $k=>&$v){
            if($k == 0){
                $style = 1;
                $v['style'] = $style;
                $v['index'] = $k+1;
                $v['color'] = "#FCE806";
            }else{
                $style = rand(1,2);
                $color_index = rand(0,2);
                $v['style'] = $style;
                $v['index'] = $k+1;
                $v['color'] = $colors[$color_index];
            }

        }
//        dump($hot_cases);
//        die;
        $this->assign('hot_cases',$hot_cases);
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
            'photo'=> $user_info['photo'],
            'token' => $token,
            'expire'=>time(),
        );
        json(200,"登录成功");

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
            'expire'=>time(),
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
        $order_type = I('order_type',1);
        $key_word = I('key_word');
        if($key_word){
            $where['title'] = array('like',"%$key_word%");
        }
        if($order_type == 1){
            $order = "created_at desc";
        }elseif ($order_type == 2){
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
        $this->assign('key_word',$key_word);
        $this->assign('show',$show);
        $this->assign('order_type',$order_type);
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
            json(110,"网络错误，图片上传说失败");
        }
        $img_info = uploadImg('cases');
        if($img_info === false){
            json(110,"图片上传失败,请检查图片格式及大小是否符合要求");
        }
        $img_url = 'http://127.0.0.1/honeypot/Uploads/'.$img_info;
        $data = array(
            'user_id' => $_SESSION['honeypot']['id'],
            'image_url' => $img_url,
        );
        if($this->draftImgModel->create($data,'addDraft') === false){
            unlink('./Uploads/'.$img_info);
            json(110,"网络错误，图片上传说失败");
        }
        $draft_id = $this->draftImgModel->add();
        if($draft_id === false){
            unlink('./Uploads/'.$img_info);
            json(110,"网络错误，图片上传说失败");
        }
        $result_data = array(
            'draft_id' => $draft_id,
            'image' => $img_url
        );
        json(200,'上传成功',$result_data);
    }

    /**
     * 移除图片
     */
    public function removeCaseImg()
    {
        $draft_id = I('post.draft_id');
        $image = I('post.image');
        if(!$draft_id || !$image){
            json(110,"删除图片失败，请重试");
        }
        if($this->draftImgModel->where(['id'=>$draft_id])->delete() === false){
            json(110,"删除图片失败，请重试");
        }
        $image = explode('honeypot/Uploads',$image);
        unlink('./Uploads'.$image[1]);
        json();
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
        $draft_id = I('post.draft_id');
//        dump(!$images);die;
        if(!$images){
            json(110,"请至少上传一张封面图");
        }
        $images = explode(',',$images);
        $draft_id = explode(',',$draft_id);
        $_POST['cover_img'] = $images[0];
        $_POST['user_id'] = $_SESSION['honeypot']['id'];
        array_splice($images,0,1);
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
                $img_data = array(
                    'cases_id' => $cases_id,
                    'image' => $v,
                );
                if($this->casesImageModel->create($img_data,'addCases') === false){
                    $this->casesModel->rollback();
                    json(110,'作品上传失败，请重试');
                }
                if($this->casesImageModel->add() === false){
                    $this->casesModel->rollback();
                    json(110,'作品上传失败，请重试');
                }
            }
        }
        if($draft_id){
            foreach ($draft_id as $k=>$v){
                if($this->draftImgModel->where(['id'=>$v])->delete() === false){
                    $this->casesModel->rollback();
                    json(110,'作品上传失败，请重试');
                }
            }
        }
        $this->casesModel->commit();
        json(200,"作品上传成功");
    }

    /**
     * 作品详情页
     */
    public function getCases()
    {
        $cases_id = I('get.cases_id');
        $cases = $this->casesModel
            ->join('user AS u on u.id = c.user_id')
            ->field('c.id,c.title,c.cover_img,c.collect_count,c.comment_count,c.created_at,u.nickname,u.photo,c.synopsis')
            ->where(['c.id'=>$cases_id])
            ->alias('c')
            ->find();
        $cases['images'] = $this->casesImageModel
            ->field('image')
            ->where(['cases_id'=>$cases_id])
            ->select();
        $comment_count = $this->casesCommentModel
            ->join('user AS u on u.id = cm.user_id')
            ->where(['cm.cases_id'=>$cases_id])
            ->alias('cm')
            ->count();
        $page = new \Think\Page($comment_count,10);
        $show = $page->show();
        $comment = $this->casesCommentModel
            ->join('user AS u on u.id = cm.user_id')
            ->field('u.photo,u.nickname,cm.id,cm.content,cm.user_id,cm.cases_id,cm.created_at')
            ->where(['cm.cases_id'=>$cases_id])
            ->limit($page->firstRow,$page->listRows)
            ->order('cm.created_at desc')
            ->alias('cm')
            ->select();
        $is_collect = $this->collectModel->where(array('user_id'=>$_SESSION['honeypot']['id'],'cases_id'=>$cases_id))->find();
        $this->assign('is_collect',$is_collect);
        $this->assign('show',$show);
        $this->assign('comment',$comment);
        $this->assign('cases',$cases);
        $this->assign('cases_id',$cases_id);
        $this->display();
    }


    /**
     * 评论
     */
    public function addReply()
    {
        $_POST['user_id'] = $_SESSION['honeypot']['id'];
        $cases_id = I('post.cases_id');
        $this->casesCommentModel->startTrans();
        if($this->casesCommentModel->create('','addCasesComment') === false){
            $this->casesCommentModel->rollback();
            json(110,$this->casesCommentModel->getError());
        }
        if($this->casesCommentModel->add() === false){
            $this->casesCommentModel->rollback();
            json(110,"回复失败");
        }
        if($this->casesModel->where(['id'=>$cases_id])->setInc('comment_count',1) === false){
            $this->casesCommentModel->rollback();
            json(110,"回复失败");
        }
        $this->casesCommentModel->commit();
        json(200,"回复成功");
    }
    
    
    
    /**
     * 收藏作品
     */
    public function collectCases()
    {
        $_POST['user_id'] = $_SESSION['honeypot']['id'];
        $cases_id = I('post.cases_id');
        $cases = $this->casesModel
            ->where(['id'=>$cases_id])
            ->find();
        if($_POST['user_id'] == $cases['user_id']){
            json(110,"不能收藏自己的作品");
        }
        $this->collectModel->startTrans();
        if($this->collectModel->create('','collectCases') === false){
            $this->collectModel->rollback();
            json(110,$this->collectModel->getError());
        }
        if($this->collectModel->add() === false){
            $this->collectModel->rollback();
            json(110,"评论失败");
        }
        if($this->casesModel->where(['id'=>$cases_id])->setInc('collect_count',1) === false){
            $this->collectModel->rollback();
            json(110,"收藏失败");
        }
        $this->casesModel->commit();
        json(200,"收藏成功");
    }


    public function cancelCollect()
    {
        $where['user_id'] = $_SESSION['honeypot']['id'];
        $where['cases_id'] = I('post.cases_id');
        if(!$where['user_id'] || !$where['cases_id']){
            json(110,"取消收藏失败");
        }
        $this->collectModel->startTrans();
        if($this->collectModel->where($where)->delete() === false){
            $this->collectModel->rollback();
            json(110,"取消收藏失败");
        }
        if($this->casesModel->where(['id'=>$where['cases_id']])->setDec('collect_count',1) === false){
            $this->collectModel->rollback();
            json(110,"取消收藏失败");
        }
        $this->casesModel->commit();
        json(200,"取消收藏成功");
    }
}