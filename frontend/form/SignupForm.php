<?php
namespace frontend\form;

use common\models\Member;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $phone;
    public $password;
    public $readMe;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Member', 'message' => '该账号已经被注册.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Member', 'message' => '该邮箱已经被注册.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return Member|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $member = new Member();
            $member->username = $this->username;
            $member->email = $this->email;
            $member->setPassword($this->password);
            $member->generateAuthKey();
            if ($member->save()) {
                return $member;
            }
        }

        return null;
    }

    public function attributeLabels()
    {
        return [
            'readMe' => '我同意接受条款'
        ];
    }
}
