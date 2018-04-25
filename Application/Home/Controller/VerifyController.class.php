<?php
namespace Home\Controller;
use Think\Controller;
class VerifyController extends Controller {
	//http://localhost/learn/index.php/Home/Veirfy/veirfy
    public function verify(){ 
    	$config = array(
    			'length' => 4,
    			'useCurve'  =>  false,            // 是否画混淆曲线
        		'useNoise'  =>  false,
        		'reset'     =>  false,

    		);
    	$Verify =     new \Think\Verify($config);
		// 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
		$Verify->useImgBg = true;	
		$Verify->entry();
    }

}