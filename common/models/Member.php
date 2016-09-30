<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $auth_key
 * @property integer $sex
 * @property integer $type
 * @property string $nickname
 * @property string $qq
 * @property string $phone
 * @property string $email
 * @property string $header_img
 * @property integer $status
 * @property integer $flag
 * @property string $create_time
 * @property string $last_ip
 * @property string $last_time
 * @property integer $card_id
 * @property integer $source
 */
class Member extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 1;
    const STATUS_ACTIVE = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'auth_key'], 'required'],
            [['sex', 'type', 'status', 'flag', 'card_id', 'source'], 'integer'],
            [['create_time', 'last_time','password_reset_token'], 'safe'],
            [['username', 'nickname', 'qq'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 50],
            [['header_img'], 'string', 'max' => 150],
            [['last_ip'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'auth_key' => 'Auth Key',
            'sex' => 'Sex',
            'type' => 'Type',
            'nickname' => 'Nickname',
            'qq' => 'Qq',
            'phone' => 'Phone',
            'email' => 'Email',
            'header_img' => 'Header Img',
            'status' => 'Status',
            'flag' => 'Flag',
            'create_time' => 'Create Time',
            'last_ip' => 'Last Ip',
            'last_time' => 'Last Time',
            'card_id' => 'Card ID',
            'source' => 'Source',
        ];
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $usernameType = static::checkLoginType($username);
        if ($usernameType === Yii::$app->params['generalLogin']) {
            return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
        }
        if ($usernameType === Yii::$app->params['emailLogin']) {
            return ;
        }
        if ($usernameType === Yii::$app->params['phoneLogin']) {
            return ;
        }
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * 检测登录名类型
     * @param $username
     * @return bool
     */
    public static function checkLoginType($username)
    {
        if(preg_match('#^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$#i',$username)) {
            return Yii::$app->params['emailLogin'];
        }
        if(preg_match('#^1[3|4|5|7]\\d{9}$#',$username)) {
            return Yii::$app->params['phoneLogin'];
        }
        return Yii::$app->params['generalLogin'];
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
