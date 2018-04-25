<?php
namespace Admin\Model;
use Think\Model;
class AuthruleModel extends Model {
	protected $tableName="auth_rule";
	protected $_validate = array(
						array('controller','require','控制器不能为空'),
						array('controller_name','require','控制器名不能为空 '),
						array('title','require','验证规则不能为空'),
						array('title_name','require','规则名不能为空'),
						array('title','','验证规则已存在','0','unique','3'),
						array('title_name','','规则名已存在','0','unique','3'),

		);

	protected $_auto = array ( 
         array('id',"creatId",1,'callback'),  // 新增的时候把status字段设置为1
     );


	public function allRules($value='')
	{
		return $this->select();
	}



	public function creatId($value='')
	{
		return "GZ".time();
	}
}