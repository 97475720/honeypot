<?php
namespace Admin\Model;
use Think\Model;
class GroupaccessModel extends Model {
	protected $tableName="auth_group_access";

	public function joinSearch($value='')
	{
		return $this->join("think_auth_group on think_auth_group.id = think_auth_group_access.group_id")
			   		->field()
			 		->select();	
	}		

	public function accessDelete($val)
	{
			return $this->where($val)->delete();
	}	
}