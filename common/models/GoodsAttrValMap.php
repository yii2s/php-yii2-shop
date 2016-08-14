<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_goods_attr_val_map}}".
 *
 * @property string $id
 * @property string $gid
 * @property string $aid
 * @property integer $vid
 */
class GoodsAttrValMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_goods_attr_val_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'aid', 'vid'], 'required'],
            [['gid', 'aid', 'vid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gid' => 'Gid',
            'aid' => 'Aid',
            'vid' => 'Vid',
        ];
    }
}
