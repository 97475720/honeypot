<?php

function json($code = 200, $msg = 'success', $data = [])
{
    $array = [];
    $array['code'] = !empty($code) ? $code : 200;
    $array['msg'] = !empty($msg) ? $msg : 'success';
    if ($data) {
        $array['data'] = $data;
    } else {
        $array['data'] = [];
    }
    ajaxReturn($array);
    return;
}

/**
 * Ajax方式返回数据到客户端
 * @access protected
 * @param mixed $data 要返回的数据
 * @param String $type AJAX返回数据格式
 * @return void
 */
function ajaxReturn($data, $type = '')
{
    if (empty($type)) $type = 'JSON';
    switch (strtoupper($type)) {
        case 'JSON' :
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:application/json; charset=utf-8');
            exit(json_encode($data));
        case 'XML'  :
            // 返回xml格式数据
            header('Content-Type:text/xml; charset=utf-8');
            exit(xml_encode($data));
        case 'JSONP':
            // 返回JSON数据格式到客户端 包含状态信息
            header('Content-Type:application/json; charset=utf-8');
            $handler = isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
            exit($handler . '(' . json_encode($data) . ');');
        case 'EVAL' :
            // 返回可执行的js脚本
            header('Content-Type:text/html; charset=utf-8');
            exit($data);
    }
}
/**
 * 图片上传
 * @param string $name
 * @return string
 */
function uploadImg($name)
{
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize = 3145728;// 设置附件上传大小
    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath = './Uploads/'; // 设置附件上传根目录
    $upload->savePath = $name; // 设置附件上传（子）目录
    // 上传文件
    $info = $upload->upload();
    if (!$info) {// 上传错误提示错误信息
//        $this->error($upload->getError());
        return false;
    } else {// 上传成功 获取上传文件信息
        foreach ($info as $file) {
            return $file['savepath'] . $file['savename'];
        }
    }
}
/**
 * 生成随机字符串
 *
 * @access public
 * @param integer $length 字符串长度
 * @param bool $specialChars 是否有特殊字符
 * @return string
 */
function randString($length, $specialChars = false)
{
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    if ($specialChars) {
        $chars .= '!@#$%^&*()';
    }
    $result = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $result .= $chars[rand(0, $max)];
    }
    return $result;
}




function filt($string)
{
	return md5($string."a1b2c3");
}

function judgeGroup($v,$string)
{
	foreach ($v as $key => $value) {
		if(in_array($string, $value)){
			return $value["title_name"];
		}

	}
	return"";

}


function autoId()
{
	$goods_id = "33166252101".time().rand(10000000001,99999999999);
	$map['id']=$goods_id;
	if(M("lp_goods")->where($map)->find()){
		$goods_id = autoId();
	}
		return $goods_id;

}

function checkVerify($code, $id = '')
{
	$config = array('reset' => false);
    $verify = new \Think\Verify($config);
    return $verify->check($code, $id);
}

?>