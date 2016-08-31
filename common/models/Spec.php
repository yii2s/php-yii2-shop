<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%spec}}".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 * @property integer $type
 * @property string $note
 * @property integer $is_del
 * @property integer $seller_id
 */
class Spec extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%spec}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['value'], 'string'],
            [['type', 'is_del', 'seller_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['note'], 'string', 'max' => 255],
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
            'value' => 'Value',
            'type' => 'Type',
            'note' => 'Note',
            'is_del' => 'Is Del',
            'seller_id' => 'Seller ID',
        ];
    }
}
