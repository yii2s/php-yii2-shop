<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%iwebshop_category}}".
 *
 * @property string $id
 * @property string $name
 * @property string $parent_id
 * @property integer $sort
 * @property integer $visibility
 * @property string $keywords
 * @property string $descript
 * @property string $title
 * @property string $seller_id
 *
 * @property IwebshopCategoryExtend[] $iwebshopCategoryExtends
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%iwebshop_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],
            [['parent_id', 'sort', 'visibility', 'seller_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['keywords', 'descript', 'title'], 'string', 'max' => 255],
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
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'visibility' => 'Visibility',
            'keywords' => 'Keywords',
            'descript' => 'Descript',
            'title' => 'Title',
            'seller_id' => 'Seller ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIwebshopCategoryExtends()
    {
        return $this->hasMany(IwebshopCategoryExtend::className(), ['category_id' => 'id']);
    }

    public function getCategoryAttrMaps()
    {
        return $this->hasMany(CategoryAttrMap::className(), ['cid' => 'id']);
    }

    public function getAttrs()
    {
        return $this->hasMany(Attr::className(), ['id' => 'aid'])->via('categoryAttrMaps');
    }
}
