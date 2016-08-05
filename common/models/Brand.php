<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%iwebshop_brand}}".
 *
 * @property string $id
 * @property integer $vid
 * @property string $name
 * @property string $logo
 * @property string $url
 * @property string $description
 * @property integer $sort
 * @property string $category_ids
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%iwebshop_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vid', 'name'], 'required'],
            [['vid', 'sort'], 'integer'],
            [['description'], 'string'],
            [['name', 'logo', 'url', 'category_ids'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vid' => 'Vid',
            'name' => 'Name',
            'logo' => 'Logo',
            'url' => 'Url',
            'description' => 'Description',
            'sort' => 'Sort',
            'category_ids' => 'Category Ids',
        ];
    }
}
