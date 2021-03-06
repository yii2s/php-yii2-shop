<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%attr_value}}".
 *
 * @property string $id
 * @property string $aid
 * @property string $name
 * @property integer $status
 * @property integer $sort
 */
class AttrValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attr_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'name'], 'required'],
            [['aid', 'status', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aid' => 'Aid',
            'name' => 'Name',
            'status' => 'Status',
            'sort' => 'Sort',
        ];
    }

    /**
     * @brief 获取属性
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attr::className(), ['id' => 'aid']);
    }
}
