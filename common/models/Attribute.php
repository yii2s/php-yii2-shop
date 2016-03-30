<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wzc_attribute}}".
 *
 * @property string $id
 * @property string $title
 * @property integer $categoryID
 * @property integer $inputType
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'categoryID'], 'required'],
            [['categoryID', 'inputType'], 'integer'],
            [['title'], 'string', 'max' => 100],
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
            'categoryID' => 'Category ID',
            'inputType' => 'Input Type',
        ];
    }
}
