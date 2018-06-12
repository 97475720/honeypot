<?php

namespace App\Behaviors;


use Think\Behavior;
use Think\Controller;

class CheckLoginBehavior extends Behavior
{
    /**
     * @param mixed $params
     * @return bool
     */
    public function run(&$params)
    {
        //$controller = CONTROLLER_NAME;
        //if($controller == 'Third'){
        //    return true;
        //}
        $url = implode('/', [MODULE_NAME,CONTROLLER_NAME, ACTION_NAME]);
        $paths = C('NOT_LOGIN');
        if (in_array($url, $paths)) {
            return true;
        }
        $token = I('post.token');
        $user_id = I('post.user_id');
        if (!$token || !$user_id) {
            json(100, C('CODE.100'));
        }
        $login_info = M('user')->where(['app_token' => $token, 'id' => $user_id])->find();
        if ($login_info) {
            return true;
        }
        json(100, C('CODE.100'));
    }
}