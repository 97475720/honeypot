<?php
namespace Home\Model;
use Think\Model;
class CasesModel extends Model {
    protected $tableName="cases";

    protected $_validate = array(

        array('user_id', 'require', '没有登录',self::MUST_VALIDATE,'','addCases'),
        array('title', 'require', '请填写作品标题',self::MUST_VALIDATE,'','addCases'),
        array('synopsis', 'require', '请填写作品简介',self::MUST_VALIDATE,'','addCases'),
        array('title', 'titleLength', '作品标题长度不符合规则',self::MUST_VALIDATE,'callback','addCases'),
        array('synopsis', 'synopsisLength', '作品简介长度不符合规则',self::MUST_VALIDATE,'callback','addCases'),
        array('cover_img', 'require', '请上传作品封面图',self::MUST_VALIDATE,'','addCases'),
        array('type', 'require', '请选择作品是否收费',self::MUST_VALIDATE,'','addCases'),
        array('integral', 'require', '请输入购买作品所需积分',self::MUST_VALIDATE,'','addCases'),

    );

    protected $_auto = array(
        array('collect_count',0,'addCases'),
        array('comment_count',0,'addCases'),
        array('created_at',NOW_TIME,'addCases'),
        array('updated_at',NOW_TIME,self::MODEL_BOTH),
    );

    /**
     * 验证字符串长度
     * @param $val
     * @param $len
     * @return bool
     */
    public function verifyStrLength($val,$len)
    {
        if(mb_strlen($val)>$len){
            return false;
        }else{
            return true;
        }
    }
    public function titleLength($val)
    {
        $this->verifyStrLength($val,20);
    }
    public function synopsisLength($val)
    {
        $this->verifyStrLength($val,100);
    }
}