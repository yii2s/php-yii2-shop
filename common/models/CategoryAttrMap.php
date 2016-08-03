<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%iwebshop_category_attr_map}}".
 *
 * @property string $id
 * @property string $cid
 * @property string $aid
 */
class CategoryAttrMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%iwebshop_category_attr_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'aid'], 'required'],
            [['cid', 'aid'], 'integer']
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
            'aid' => 'Aid',
        ];
    }
}
