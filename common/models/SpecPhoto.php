<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%spec_photo}}".
 *
 * @property string $id
 * @property string $address
 * @property string $name
 * @property string $create_time
 */
class SpecPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%spec_photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time'], 'safe'],
            [['address'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'name' => 'Name',
            'create_time' => 'Create Time',
        ];
    }
}
