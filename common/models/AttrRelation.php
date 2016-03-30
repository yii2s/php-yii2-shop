<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wzc_attr_relation}}".
 *
 * @property string $id
 * @property string $attrID
 * @property string $valueID
 */
class AttrRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_attr_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attrID', 'valueID'], 'required'],
            [['attrID', 'valueID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attrID' => 'Attr ID',
            'valueID' => 'Value ID',
        ];
    }
}
