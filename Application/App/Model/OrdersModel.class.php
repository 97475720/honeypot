<?php
namespace App\Model;
use Think\Model;
class OrdersModel extends Model {

    protected $tableName = 'orders';

    protected $_validate = array(

        array('user_id', 'require', '购买失败',self::MUST_VALIDATE,'','add'),
        array('cases_id', 'require', '购买失败',self::MUST_VALIDATE,'','add'),

    );

    protected $_auto = array(
        array('created_at',NOW_TIME,'add'),
    );
}