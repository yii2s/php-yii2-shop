<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wzc_shop}}".
 *
 * @property string $id
 * @property string $title
 * @property integer $userID
 * @property string $createTime
 * @property string $creditScore
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_shop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'userID'], 'required'],
            [['userID', 'creditScore'], 'integer'],
            [['createTime'], 'safe'],
            [['title'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'userID' => 'User ID',
            'createTime' => 'Create Time',
            'creditScore' => 'Credit Score',
        ];
    }
}
