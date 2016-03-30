<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wzc_brand_relation}}".
 *
 * @property string $id
 * @property string $brandID
 * @property string $categoryID
 */
class BrandRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_brand_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brandID', 'categoryID'], 'required'],
            [['brandID', 'categoryID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brandID' => 'Brand ID',
            'categoryID' => 'Category ID',
        ];
    }
}
