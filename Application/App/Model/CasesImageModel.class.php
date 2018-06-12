<?php
namespace App\Model;
use Think\Model;
class CasesImageModel extends Model {
    protected $tableName="cases_image";

    protected $_validate = array(

        array('cases_id', 'require', '作品ID缺失',self::MUST_VALIDATE,'','addCases'),
        array('image', 'require', '作品图片缺失',self::MUST_VALIDATE,'','addCases'),

    );

    protected $_auto = array(
        array('created_at',NOW_TIME,'addCases'),
        array('updated_at',NOW_TIME,self::MODEL_BOTH),
    );


    /**
     * 获取想要作品的图片
     */
    public function getImage($cases_id,$user_id)
    {
        $where['user_id'] = $user_id;
        $where['cases_id'] = $cases_id;
        return $this->where($where)->field('image')->select();
    }
}