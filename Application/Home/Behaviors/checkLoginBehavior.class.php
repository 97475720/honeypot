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
            die(redirect($_SERVER['HTTP_REFERER'].'?index_type=1'));
        }
        $login_info = M('user')->where(['token' => $token, 'id' => $user_id])->find();
        if ($login_info) {
            return true;
        }
        if (IS_POST) {
            json(100, "没有登录");
        }
        die(redirect($_SERVER['HTTP_REFERER'].'?index_type=1'));
    }

}