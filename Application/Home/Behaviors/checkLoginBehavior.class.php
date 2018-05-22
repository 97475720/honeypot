<?php

namespace Home\Behaviors;


use Think\Behavior;

class checkLoginBehavior extends Behavior
{
    /**
     * @param mixed $params
     * @return bool
     */
    public function run(&$params)
    {
        $url = implode('/', [MODULE_NAME, CONTROLLER_NAME, ACTION_NAME]);
        $paths = C('NOT_NEED_Login');
        $referer_url = $_SERVER['HTTP_REFERER'];
        $token = $_SESSION['honeypot']['token'];
        $user_id = $_SESSION['honeypot']['id'];
        $expire = $_SESSION['honeypot']['expire'];
        $time = time()-$expire;
        if($expire && $time<3600){
            $_SESSION['honeypot']['expire'] = time();
        }else{
            $_SESSION['honeypot'] = '';
        }
        //不需要登录的方法
        if (in_array($url, $paths)) {
            return true;
        } elseif (!$_SESSION['honeypot']) {
            if (IS_POST) {
                json(100, "没有登录");
            }
            //如果上一个请求地址存在
            if($referer_url){
                //去找这个地址是否有get参数
                $redirect_url = strstr($referer_url,'?',true);
                //如果有参数
                if($redirect_url){
                    die(redirect($redirect_url.'$index_type=1'));
                }
                //没有get参数的话
                die(redirect($referer_url.'?index_type=1'));
            }
            die(redirect("http://localhost/honeypot/index.php/Home/Index/index?index_type=1"));
        }
        $login_info = M('user')->where(['token' => $token, 'id' => $user_id])->find();
        if ($login_info) {
            return true;
        }
        if (IS_POST) {
            json(100, "没有登录");
        }
        if($referer_url){
            $redirect_url = strstr($referer_url,'?',true);
            if($redirect_url){
                die(redirect($redirect_url.'?index_type=1'));
            }
            die(redirect($referer_url.'?index_type=1'));
        }
        die(redirect('http://localhost/honeypot/index.php/Home/index/index?index_type=1'));
    }

}