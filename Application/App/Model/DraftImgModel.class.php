<?php
namespace App\Model;
use Think\Model;
class DraftImgModel extends Model {

    protected $tableName = 'draft_image';

    protected $_validate = array(

        array('user_id', 'require', '用户ID缺失',self::MUST_VALIDATE,'','addDraft'),
        array('image_url', 'require', '图片路径缺失',self::MUST_VALIDATE,'','addDraft'),

    );

    protected $_auto = array(
        array('is_publish',0,'addDraft'),
        array('created_at',NOW_TIME,'addDraft'),
    );
}