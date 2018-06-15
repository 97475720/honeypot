<?php
namespace App\Controller;
use Think\Controller;
class IndexController extends Controller {

    /**
     * @var \App\Model\UserModel
     */
    private $userModel;
    /**
     * @var \App\Model\CasesModel
     */
    private $casesModel;
    /**
     * @var \App\Model\DraftImgModel
     */
    private $draftImgModel;
    /**
     * @var \App\Model\CasesImageModel
     */
    private $casesImageModel;
    /**
     * @var \App\Model\CasesCommentModel
     */
    private $casesCommentModel;
    /**
     * @var \App\Model\CollectModel
     */
    private $collectModel;
    /**
     * @var \App\Model\SearchKeyModel
     */
    private $searchKeyModel;
    /**
     * @var \App\Model\IntegralModel
     */
    private $integralModel;
    /**
     * @var \App\Model\OrdersModel
     */
    private $ordersModel;

    public function _initialize()
    {
        $this->userModel = D('user');
        $this->casesModel = D('cases');
        $this->draftImgModel = D('DraftImg');
        $this->casesCommentModel = D('CasesComment');
        $this->casesImageModel = D('CasesImage');
        $this->collectModel = D('Collect');
        $this->searchKeyModel = D('SearchKey');
        $this->integralModel = D('Integral');
        $this->ordersModel = D('Orders');
    }


    /**
     * 首页列表
     */
    public function getImgList()
    {
        $page = I('post.page',1);
        $key_word = I('post.key_word');
        $page_size = 20;
        if($key_word){
            $where['title'] = array('like',"%$key_word%");
        }else{
            $where = true;
        }
        $count = $this->casesModel
            ->where($where)
            ->count();
        $list['list'] = $this->casesModel
            ->field('id,title,synopsis,cover_img,collect_count,comment_count')
            ->where($where)
            ->page($page,$page_size)
            ->order('collect_count desc')
            ->select();
        if(!$list['list']){
            json('','',(object)array());
        }
        $list['total_page'] = ceil($count/$page_size);
        json('','',$list);

    }
    
    /**
     * 收藏
     */
    public function collectCases()
    {
        $cases_id = I('post.cases_id');
        $user_id = I('post.user_id');
        $cases = $this->casesModel
            ->where(['id'=>$cases_id])
            ->find();
        if($user_id == $cases['user_id']){
            json(110,"不能收藏自己的作品",(object)array());
        }
        $where['user_id'] = $user_id;
        $where['cases_id'] = $cases_id;
        $is_collect = $this->collectModel
            ->where($where)
            ->find();
        if($is_collect){
            json(110,'请勿重复收藏',(object)array());
        }
        $this->collectModel->startTrans();
        if($this->collectModel->create('','collectCases') === false){
            json(110,'收藏失败',(object)array());
        }
        if($this->collectModel->add() === false){
            json(110,'收藏失败',(object)array());
        }
        if($this->casesModel->where(['id'=>$cases_id])->setInc('collect_count',1) === false){
            json(110,'收藏失败',(object)array());
        }
        $this->collectModel->commit();
        json('','',(object)array());
    }

    
    /**
     * 获取用户收藏列表
     */
    public function getMyCollectList()
    {
        $user_id = I('post.user_id');
        $page = I('post.page',1);
        $page_size = 20;
        $count = $this->userModel
            ->join('collect on collect.user_id = user.id')
            ->join('cases on cases.id = collect.cases_id')
            ->where(['user.id'=>$user_id])
            ->count();
        $result['list'] = $this->userModel
            ->join('collect AS cl on cl.user_id = u.id')
            ->join('cases AS c on c.id = cl.cases_id')
            ->field('c.title,c.id,c.synopsis,c.cover_img,c.collect_count,c.comment_count')
            ->page($page,$page_size)
            ->where(['u.id'=>$user_id])
            ->alias('u')
            ->select();
        if(!$result['list']){
            json('','',(object)array());
        }
        $result['total_page'] = ceil($count/$page_size);
        json('','',$result);
    }


    /**
     * 个人信息
     */
    public function getMyInfo()
    {
        $user_id = I('post.user_id');
        $info = $this->userModel
            ->field('id,username,nickname,photo')
            ->where(['id'=>$user_id])
            ->find();
        $info['integral'] = $this->integralModel->where(['user_id'=>$user_id])->field('integral')->find()['integral'];
        json('','',$info);
    }


    /**
     * 作品详情页
     */
    public function getCasesInfo()
    {
        $cases_id = I('post.cases_id');
        $user_id = I('post.user_id');
        $token = I('post.token');
        $is_login = $this->userModel
            ->where(['id'=>$user_id,'app_token'=>$token])
            ->find();
        $cases = $this->casesModel
            ->join('user AS u on u.id = c.user_id')
            ->field('c.id,c.user_id,u.nickname,u.photo,c.title,c.synopsis,c.cover_img,c.collect_count,c.comment_count,c.created_at,c.type,c.integral')
            ->where(['c.id'=>$cases_id])
            ->alias('c')
            ->find();
        if($cases){
            $cases['created_at'] = date('Y-m-d H:i:s',$cases['created_at']);
        }
        //如果没有登录
        if(!$is_login){
            switch ($cases['type']){
                case 1:
                    $cases['is_buy'] = 1;
                    $cases['img'] = $this->casesImageModel->getImage($cases_id,$user_id);
                    break;
                case 2:
                    $cases['is_buy'] = 2;
                    $cases['img'] = array();
            }

            json('','',$cases);
        }
        switch ($cases['type']){
            case 1:
                $cases['is_buy'] = 1;
                $cases['img'] = $this->casesImageModel->getImage($cases_id,$user_id);

            break;
            case 2:
                $where['cases_id'] = $cases_id;
                $where['user_id'] = $user_id;
                $is_buy = $this->ordersModel
                    ->where($where)
                    ->find();
                if($user_id = $cases['user_id']){
                    $cases['is_buy'] = 3;
                    $cases['img'] = $this->casesImageModel->getImage($cases_id,$user_id);
                }else{
                    if($is_buy){
                        $cases['is_buy'] = 3;
                        $cases['img'] = $this->casesImageModel->getImage($cases_id,$user_id);
                    }else{
                        $cases['is_buy'] = 2;
                        $cases['img'] = array();
                    }
                }
                break;
            default:
                $cases['is_buy'] = 0;
                $cases['img'] = array();
        }
        json('','',$cases);
    }


    /**
     * 购买作品
     */
    public function buyCases()
    {
        $user_id = I('post.user_id');
        $cases_id = I('post.cases_id');
        $cases = $this->casesModel
            ->field('id,integral')
            ->where(['id'=>$cases_id])
            ->find();
        $user_integral = $this->integralModel
            ->field('id,user_id,integral')
            ->where(['user_id'=>$user_id])
            ->find();
        if($user_integral['integral'] - $cases['integral'] <0){
            json(110,'购买失败，您的积分不足',(object)array());
        }
        $this->integralModel->startTrans();
        if($this->integralModel->where(['id'=>$user_integral['id']])->setDec('integral',$cases['integral']) === false){
            $this->integralModel->rollback();
            json(110,'购买失败',(object)array());
        }
        $order_data = array(
            'user_id'=>$user_id,
            'cases_id'=>$cases_id,
        );
        if($this->ordersModel->create($order_data,'add') === false){
            $this->integralModel->rollback();
            json(110,'购买失败',(object)array());
        }
        if($this->ordersModel->add() === false){
            $this->integralModel->rollback();
            json(110,'购买失败',(object)array());
        }
        $images = $this->casesImageModel
            ->field('image')
            ->where(['cases_id'=>$cases_id])
            ->select();
        $this->integralModel->commit();
        json('','',$images);
    }
}