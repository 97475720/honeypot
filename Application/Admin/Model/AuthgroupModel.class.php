<?php
namespace Admin\Model;
use Think\Model;
class AuthgroupModel extends Model {
	protected $tableName="auth_group";
	protected $_validate = array(
						array('title','','该分组已存在','0','unique','3'),
						array('title','require','请输入分组'),
						array('title_name','','分组名已存在','0','unique','3'),
						array('titel_name','require','请输入分组名'),

		);

	protected $_auto = array ( 
         array('id',"creatId",1,'callback'),  // 新增的时候把status字段设置为1
     );

	public function creatId($value='')
	{
		return 'FZ'.time();
	}


	public function DeleteGroup($group_id)
	{
		return $this->where($group_id)->delete();
	}
	public function joinSelect($val="")
	{
			   $this->join('think_auth_group_access on think_auth_group.id = think_auth_group_access.group_id')
					->field()
					->select();

	}


	public function allGroup($value='')
	{
		return $this->field($value)->select();
	}


	public function nowGroup($value)
	{
		return $this->where($value)->find();
	}

	public function saveRules($group_id,$rules)
	{
		return $this->where($group_id)->save($rules);
	}

	public function saveStatus($val,$value)
	{
		return $this->where($val)->save($value);
	}
}