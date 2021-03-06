<?php
namespace backend\form;

use backend\models\Admin;
use common\models\Member;
use common\utils\ClientUtils;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $captcha;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required','message' => '{attribute}不能为空'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $admin = $this->getAdmin();
            if (!$admin || !$admin->validatePassword($this->password)) {
                $this->addError($attribute, '密码不正确');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * 登录成功更新最后登录时间和最后登录IP
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $admin = $this->getAdmin();
            if (Yii::$app->user->login($admin, $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                /*$admin->updateAdminAttributes([
                    'lastTime' => date('Y-m-d H:i:s',time()),
                    'lastIP'   => ClientUtils::getClientIp(),
                ]);*/
                return true;
            }
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getAdmin()
    {
        if ($this->_user === null) {
            $this->_user = Admin::findByUsername($this->username);
        }
        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password' => '密码',
        ];
    }
}
