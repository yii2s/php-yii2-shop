<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $id
 * @property string $loginName
 * @property string $loginPwd
 * @property string $authKey
 * @property integer $sex
 * @property integer $type
 * @property string $nickName
 * @property string $qq
 * @property string $phone
 * @property string $email
 * @property string $headerImg
 * @property integer $status
 * @property integer $flag
 * @property string $createTime
 * @property string $lastIP
 * @property string $lastTime
 * @property integer $cardID
 * @property integer $source
 */
class Member extends ActiveRecord implements IdentityInterface
{
    const STATUS = 0; //用户状态

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
            [['username', 'password'], 'required'],
            [['sex', 'type', 'status', 'flag', 'cardID', 'source'], 'integer'],
            [['createTime', 'lastTime'], 'safe'],
            [['username', 'nickname', 'qq'], 'string', 'max' => 20],
            [['password'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 11],
            [['email'], 'string', 'max' => 50],
            [['headerImg'], 'string', 'max' => 150],
            [['lastIP'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Login Name',
            'password' => 'Login Pwd',
            'authKey' => 'Auth Key',
            'sex' => 'Sex',
            'type' => 'Type',
            'nickname' => 'Nick Name',
            'qq' => 'Qq',
            'phone' => 'Phone',
            'email' => 'Email',
            'headerImg' => 'Header Img',
            'status' => 'Status',
            'flag' => 'Flag',
            'createTime' => 'Create Time',
            'lastIP' => 'Last Ip',
            'lastTime' => 'Last Time',
            'cardID' => 'Card ID',
            'source' => 'Source',
        ];
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
     * 获取会员
     *
     * @since 2016-02-27
     */
    public static function getMember()
    {
        return Yii::$app->user->identity;
    }

    /**
     * 更新会员属性
     *
     * @param $args 对应会员表列值
     * @return int
     * @since 2016-02-27
     */
    public function updateMemberAttributes($args)
    {
        return self::findOne($this->id)->updateAttributes($args);
    }

    /**
     * 密码设置
     * @param $password
     * @return string
     */
    public function setPassword($password)
    {
        $this->authKey  = rand(1000,9999);
        $this->password = md5($this->authKey.$password);
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

}
