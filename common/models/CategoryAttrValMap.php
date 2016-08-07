<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_category_attr_val_map}}".
 *
 * @property string $id
 * @property string $cid
 * @property string $aid
 * @property string $vid
 * @property integer $sort
 */
class CategoryAttrValMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_category_attr_val_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cid', 'aid', 'vid'], 'required'],
            [['cid', 'aid', 'sort', 'vid'], 'integer']
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
            'vid' => 'Vid',
            'sort' => 'Sort',
        ];
    }
}
