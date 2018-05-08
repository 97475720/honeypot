<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {
	protected $tableName="user";
	protected $_validate = array(

	    array('username', 'require', '请输入用户名',self::MUST_VALIDATE,'','register'),
        array('username', '', '用户名已存在',self::MUST_VALIDATE,'unique','register'),
        array('username', '6,16', '请输入6到16位的用户名',self::MUST_VALIDATE,'length','register'),
        array('nickname', 'require', '请输入昵称',self::MUST_VALIDATE,'','register'),
        array('nickname', '', '该昵称已存在',self::MUST_VALIDATE,'unique','register'),
        array('password', '', '请输入密码',self::MUST_VALIDATE,'unique','register'),
        array('repassword','password','确认密码不正确',self::MUST_VALIDATE,'confirm','register'),

        array('username', 'require', '请输入用户名',self::EXISTS_VALIDATE,'','registerVerify'),
        array('username', '', '用户名已存在',self::EXISTS_VALIDATE,'unique','registerVerify'),
        array('username', '6,16', '请输入6到16位的用户名',self::EXISTS_VALIDATE,'length','registerVerify'),
        array('nickname', 'require', '请输入昵称',self::EXISTS_VALIDATE,'','registerVerify'),
        array('nickname', '', '该昵称已存在',self::EXISTS_VALIDATE,'unique','registerVerify'),


		);

	protected $_auto = array (
        array('created_at',NOW_TIME,'register'),
        array('photo',"http://localhost/honeypot/Uploads/cases2018-05-08/59a27a02cff01.jpg",'register'),
        array('token',NOW_TIME,'register'),
        array('login_ip','createdLoginIp','register','callback'),
        array('salt','randStringSalt','register','callback'),

        array('updated_at',NOW_TIME,self::MODEL_BOTH),
     );


    /**
     * 生成登录IP
     */
    public function createdLoginIp()
    {
        return get_client_ip();
    }


	/**
     * 生成6位加密盐
     */
    public function randStringSalt()
    {
        $length = 6;
        return randString($length);
	}

	/**
     * 注册用户
     */
    public function registerNewUser()
    {
        $this->data['password'] = md5($this->data['password'].$this->data['salt']);
        return $this->add();
	}

}