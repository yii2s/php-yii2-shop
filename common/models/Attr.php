<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%attr}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property integer $sort
 */
class Attr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'sort' => 'Sort',
        ];
    }

    /**
     * @brief 获取属性值
     * @return \yii\db\ActiveQuery
     */
    public function getAttrVal() 
    {
        return $this->hasMany(AttrValue::className(), ['aid' => 'id']);
    }

}
