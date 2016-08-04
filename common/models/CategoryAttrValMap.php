<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%iwebshop_category_attr_val_map}}".
 *
 * @property string $id
 * @property string $cid
 * @property string $avid
 * @property integer $sort
 */
class CategoryAttrValMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%iwebshop_category_attr_val_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'avid'], 'required'],
            [['cid', 'avid', 'sort'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'Cid',
            'avid' => 'Avid',
            'sort' => 'Sort',
        ];
    }
}
