<?php
namespace Home\Model;
use Think\Model;
class IntegralModel extends Model {

    protected $tableName = 'integral';

    protected $_validate = array(

        array('user_id', 'require', '用户ID缺失',self::MUST_VALIDATE,'','add'),
        array('user_id', '', '用户积分记录已存在',self::MUST_VALIDATE,'unique','add'),

    );

    protected $_auto = array(
        array('updated_at',NOW_TIME,self::MODEL_BOTH),
        array('integral',0,'add'),
    );
}