<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    public function rules()
    {
        return [
            // 在这里定义验证规则
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }



    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }
}