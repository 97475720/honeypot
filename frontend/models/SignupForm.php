<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $nickname;
    public $password;
    public $verifyPassword;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [


            ['username', 'trim'],
            ['username', 'required', 'message' => '账号不能为空'],
            ['username', 'unique',  'message' => '用户名已被使用'],
            ['username', 'string', 'min' => 6, 'max' => 16],

            ['nickname', 'unique' , '用户名已被使用'],
            ['nickname', 'required', 'message' => '用户名不能为空'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'message' => '请输入密码'],
            ['password', 'string', 'min' => 6 , 'max' => 16],

            ['verifyPassword', 'required', 'message' => '请确认密码'],
            ['verifyPassword', 'string', 'min' => 6 , 'max' => 16],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->nickname = $this->nickname;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
