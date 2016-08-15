<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%task}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $price
 * @property string $thumb
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%task}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'price', 'thumb'], 'string']
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
            'price' => 'Price',
            'thumb' => 'Thumb',
        ];
    }
}
