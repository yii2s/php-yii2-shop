<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_category}}".
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
 * @property zcCategoryExtend[] $zcCategoryExtends
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_category}}';
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
    public function getzcCategoryExtends()
    {
        return $this->hasMany(zcCategoryExtend::className(), ['category_id' => 'id']);
    }

    /**
     * @brief 获取类别关联属性
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttrMaps()
    {
        return $this->hasMany(CategoryAttrMap::className(), ['cid' => 'id']);
    }

    /**
     * @brief 获取属性
     * @return \yii\db\ActiveQuery
     */
    public function getAttrs()
    {
        return $this->hasMany(Attr::className(), ['id' => 'aid'])->via('categoryAttrMaps');
    }

    /**
     * @brief 获取属性关联值
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttrValMaps()
    {
        return $this->hasMany(CategoryAttrValMap::className(), ['cid' => 'id']);
    }

    /**
     * @brief 获取类别关联属性值
     * @return $this
     */
    public function getAttrVals()
    {
        return $this->hasMany(AttrValue::className(), ['id' => 'vid'])->via('categoryAttrValMaps');
    }
}
