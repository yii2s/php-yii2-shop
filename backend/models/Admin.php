<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%wzc_admin}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $authKey
 * @property string $createTime
 * @property string $lastTime
 * @property string $lastIP
 * @property integer $groupID
 * @property integer $cardID
 * @property string $phone
 * @property string $email
 * @property string $nickname
 * @property integer $status
 */
class Admin extends ActiveRecord implements IdentityInterface
{
    const STATUS = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'createTime', 'lastTime', 'status'], 'required'],
            [['authKey', 'groupID', 'cardID', 'status'], 'integer'],
            [['createTime', 'lastTime'], 'safe'],
            [['username', 'email', 'nickname'], 'string', 'max' => 50],
            [['password', 'lastIP'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 11],
        ];
    }

    /**
     * 检测登录名类型
     *
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
     * 根据用户名查询用户信息
     * @param $username
     * @return null|static
     */
    public static function findByUsername($username)
    {
        $usernameType = static::checkLoginType($username);
        if ($usernameType === Yii::$app->params['generalLogin']) {
            return static::findOne(['username' => $username, 'status' => self::STATUS]);
        }
        if ($usernameType === Yii::$app->params['emailLogin']) {
            return static::findOne(['email' => $username, 'status' => self::STATUS]);
        }
        if ($usernameType === Yii::$app->params['phoneLogin']) {
            return static::findOne(['phone' => $username, 'status' => self::STATUS]);
        }
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return md5($this->authKey.$password) == $this->password;
    }

    /**
     * 更新管理员属性
     *
     * @param $args 对应管理员表列值
     * @return int
     * @since 2016-02-27
     */
    public function updateAdminAttributes($args)
    {
        return self::findOne($this->id)->updateAttributes($args);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS]);
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
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'createTime' => 'Create Time',
            'lastTime' => 'Last Time',
            'lastIP' => 'Last Ip',
            'groupID' => 'Group ID',
            'cardID' => 'Card ID',
            'phone' => 'Phone',
            'email' => 'Email',
            'nickname' => 'Nickname',
            'status' => 'Status',
        ];
    }
}
