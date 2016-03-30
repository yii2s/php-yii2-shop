<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%zc_admin}}".
 *
 * @property integer $adminID
 * @property integer $wzc_roleID
 * @property string $username
 * @property string $password
 * @property integer $roleID
 * @property integer $status
 */
class ZcAdmin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminID', 'username', 'password', 'roleID'], 'required'],
            [['adminID', 'wzc_roleID', 'roleID', 'status'], 'integer'],
            [['username'], 'string', 'max' => 25],
            [['password'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'adminID' => 'Admin ID',
            'wzc_roleID' => 'Wzc Role ID',
            'username' => 'Username',
            'password' => 'Password',
            'roleID' => 'Role ID',
            'status' => 'Status',
        ];
    }
}
