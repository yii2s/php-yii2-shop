<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wzc_value}}".
 *
 * @property string $id
 * @property string $value
 * @property string $attrID
 */
class Value extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_value}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'attrID'], 'required'],
            [['attrID'], 'integer'],
            [['value'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'attrID' => 'Attr ID',
        ];
    }
}
