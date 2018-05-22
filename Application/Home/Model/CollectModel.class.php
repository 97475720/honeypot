<?php
namespace Home\Model;
use Think\Model;
class CollectModel extends Model {

    protected $tableName = 'collect';

    protected $_validate = array(

        array('user_id', 'require', '没有登录',self::MUST_VALIDATE,'','collectCases'),
        array('cases_id', 'require', '请选择你要收藏的作品',self::MUST_VALIDATE,'','collectCases'),

    );

    protected $_auto = array(
        array('created_at',NOW_TIME,'collectCases'),
    );
}