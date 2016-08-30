<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $authKey
 * @property integer $sex
 * @property integer $type
 * @property string $nickname
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
class Member extends \yii\db\ActiveRecord
{
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
            [['username', 'password', 'authKey'], 'required'],
            [['authKey', 'sex', 'type', 'status', 'flag', 'cardID', 'source'], 'integer'],
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
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'sex' => 'Sex',
            'type' => 'Type',
            'nickname' => 'Nickname',
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
}
