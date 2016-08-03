<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%iwebshop_attr_value}}".
 *
 * @property string $id
 * @property string $aid
 * @property string $value
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
        return '{{%iwebshop_attr_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'value'], 'required'],
            [['aid', 'status', 'sort'], 'integer'],
            [['value'], 'string', 'max' => 50]
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
            'value' => 'Value',
            'status' => 'Status',
            'sort' => 'Sort',
        ];
    }
}
