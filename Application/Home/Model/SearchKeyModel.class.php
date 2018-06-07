<?php
namespace Home\Model;
use Think\Model;
class SearchKeyModel extends Model {

    protected $tableName = 'search_key';

    protected $_validate = array(

        array('key_word', 'require', '没有搜索key',self::MUST_VALIDATE,'','addSearchKey'),
    );

    protected $_auto = array(
        array('created_at',NOW_TIME,'addSearchKey'),
        array('search_count',1,'addSearchKey'),
    );
}