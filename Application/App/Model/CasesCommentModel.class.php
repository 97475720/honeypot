<?php
namespace App\Model;
use Think\Model;
class CasesCommentModel extends Model {
    protected $tableName="cases_comment";

    protected $_validate = array(

        array('cases_id', 'require', '作品ID缺失',self::MUST_VALIDATE,'','addCasesComment'),
        array('user_id', 'require', '作品图片缺失',self::MUST_VALIDATE,'','addCasesComment'),
        array('content', 'require', '作品图片缺失',self::MUST_VALIDATE,'','addCasesComment'),

    );

    protected $_auto = array(
        array('created_at',NOW_TIME,'addCasesComment'),
    );
}