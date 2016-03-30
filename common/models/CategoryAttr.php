<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wzc_category_attr}}".
 *
 * @property string $id
 * @property string $attrID
 * @property string $categoryID
 */
class CategoryAttr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_category_attr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attrID', 'categoryID'], 'required'],
            [['attrID', 'categoryID'], 'integer'],
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
            'categoryID' => 'Category ID',
        ];
    }
}
