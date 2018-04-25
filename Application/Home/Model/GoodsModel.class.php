<?php
namespace Home\Model;
use Think\Model;
class GoodsModel extends Model {
	protected $tableName="goods";

	public function countNum($value='')
	{
		return $this->where($value)->count();
	}

	public function likeSearch($value)
	{	
		if(!$value)return;
		$search["goods_class"] = array("like","%$value%");
		$res = $this->where($search)->order("date_save desc")->limit(4)->select();
		foreach ($res as $key => &$value) {
			$value["goods_img"] = explode(",", $value["goods_img"]);
		}
		return $res;
	}
}