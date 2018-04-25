<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model {
	protected $tableName="lp_goods";
	protected $_validate = array(
						array('goods_name','','该商品名已存在','0','unique','3'),
						array('goods_name','require','商品名不能为空'),
		);
	protected $_auto = array ( 
         array('id',"creatId",1,'callback'),  // 新增的时候把status字段设置为1
         array('date_save',"createDateSave",3,'callback'),  
     );

	public function creatId()
	{
		return autoId();
	}

	public function createDateSave($value='')
	{
		return date('Y-m-d H:i:s',time());
	}
			
}