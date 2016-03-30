<?php
namespace frontend\form;

use common\models\Member;
use common\utils\ClientUtils;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $phone;
    public $nickname;
    public $sex;
    public $qq;
    public $headerImg;
    public $password2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username','filter','filter' => 'trim'],
            ['username','required','message' => '用户名不能为空'],
            ['username','unique','targetClass' => '\common\models\Member','message' => '用户名已经被注册'],
            ['username','string','min' => 2,'max' => 255],

            ['nickname','required','message'=>'昵称不能为空'],

            ['email','filter','filter' => 'trim'],
            //['email', 'required', 'message' => '邮箱地址不能为空'],
            ['email','email','message' => '邮箱格式不正确'],
            ['email','string','max' => 255],
            ['email','unique','targetClass' => '\common\models\Member','message' => '邮箱已经被他人使用'],

            [['password','password2'],'required','message' => '密码不能为空'],
            ['password2','compare','compareAttribute' => 'password','message' => '两次密码不一致'],
            [['password','password2'],'string','min' => 2,'max' => 16,'message' => '密码是2-16位数字或字母'],

            ['phone','filter','filter' => 'trim'],
            ['phone','match','pattern'=>'/^1[0-9]{10}$/','message'=>'手机号格式不正确'],
            ['phone','unique','targetClass' => '\common\models\Member','message' => '手机号已经被他人使用'],

            ['sex','required','message' => '请先选择']
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $member = new Member();
            $member->username   = $this->username;
            $member->email      = $this->email;
            $member->sex        = $this->sex;
            $member->nickname   = $this->nickname;
            $member->phone      = $this->phone;
            $member->createTime = date('Y-m-d H:i:s',time());
            $member->lastIP     = ClientUtils::getClientIp();
            $member->lastTime   = date('Y-m-d H:i:s',time());
            $member->setPassword($this->password);
            //$member->generateAuthKey();
            if ($member->save()) {
                return $member;
            }
        }

        return null;
    }
}
