<?php
namespace Admin\Model;
use Think\Model;
class AdminuserModel extends Model {
	protected $tableName="admin_user";
	protected $_validate = array(
						array('uid','','ID已存在','0','unique','3'),
						array('uname','','该用戶名已存在','0','unique','3'),
						array('uname','require','用户名不能为空'),
						array('uphone','require','电话号码不能为空'),
						array('uphone','11','电话号码长度不符','0','length','3'),
						array('uphone','checedPhone','電話格式錯誤','0','callback','3'),
						array('uphone','','该电话号码已使用','0','unique','3'),
						array('uemail','require','邮箱号码不能为空'),
						array('uemail',"filter","邮箱格式错误",'0','callback','3'),
						array('uemail','','该邮箱已使用','0','unique','3'),
						array('pwd','6,16','请输入6到16位长度的密码','0','length','3'),
						array('pwd','require','请输入密码'),
		);

	protected $_auto = array ( 
         array('uid',"creatId",1,'callback'),  // 新增的时候把status字段设置为1
         array('upwd','jmpwd',1,'callback') , // 对password字段在新增和编辑的时候使md5函数处理
         array('headpicture','createHeadPicture',1,'callback') , // 对password字段在新增和编辑的时候使md5函数处理
     );

	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-25
	 * @参数:
	 * @方法描述: 手机号前缀验证
	 * @param    [type]     $val [description]
	 * @return   [type]          [description]
	 */
	public function checedPhone($val){
		$map = substr($val, 0,3);
		$res = array(
				'187',
				'130',
				'155',
				'151',
				'180',
				'181',
				'183',
				'135',
				'137',
				'139',
				'136',
				'138',
				'159',
				'158',
				'188',
				'189',
				'153',
				'186',
				'182',
			);
		if(in_array($map, $res)){
			return $val;
		}else{
			return false;
		}
	}



	public function createHeadPicture($value='')
	{
		return "http://localhost/lplive/Uploads/598eedbe5a358.jpg";
	}

	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-25
	 * @参数:
	 * @方法描述:邮箱格式验证
	 * @param    [type]     $value [description]
	 * @return   [type]            [description]
	 */
	public function filter($value)
	{
		$filter = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
		if(preg_match($filter,$value)){
			return $value;
		}else{
			return false;
		}
	}


	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-25
	 * @参数:
	 * @方法描述:密码加密
	 * @param    [type]     $val [description]
	 * @return   [type]          [description]
	 */
	public function jmpwd($val)
	{
		return filt($val);

	}



	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-25
	 * @参数:
	 * @方法描述: 自动完成ID创建
	 * @return   [type]     [description]
	 */
	public function creatId()
	{
		return "LP".time();
	}
	


	public function joinSelect($value,$field="")
	{
		return $this->where($value)
					->join('think_auth_group_access on think_admin_user.uid = think_auth_group_access.uid')
					->join('think_auth_group on think_auth_group.id = think_auth_group_access.group_id')
					->field($field)
					->select();
	}

	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-25
	 * @参数:
	 * @方法描述:查询到所有管理员的数量
	 * @return   [type]     [description]
	 */
	public function countNum()
	{
		return $this->count();
		
	}


	/**
	 * @Author   Hybrid
	 * @DateTime 2017-07-27
	 * @参数:
	 * @方法描述:删除管理员
	 * @param    string     $value [description]
	 * @return   [type]            [description]
	 */
	public function deleteAdmin($value)
	{
		if($value){
			return $this->where($value)->delete();
		}else{
			return false;
		}
		
	}

	public function searchAdmin($value)
	{
	   return $this->where($value)->find();
	}


	public function saveAdmin($uid,$value)
	{
		return $this->where($uid)->save($value);
	}

}