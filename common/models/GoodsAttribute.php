<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_attribute}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $attribute_id
 * @property string $attribute_value
 * @property string $model_id
 * @property integer $order
 *
 * @property zcGoods $goods
 * @property zcAttribute $attribute
 */
class GoodsAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'required'],
            [['goods_id', 'attribute_id', 'model_id', 'order'], 'integer'],
            [['attribute_value'], 'string', 'max' => 255],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => zcGoods::className(), 'targetAttribute' => ['goods_id' => 'id']],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => zcAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id' => 'Goods ID',
            'attribute_id' => 'Attribute ID',
            'attribute_value' => 'Attribute Value',
            'model_id' => 'Model ID',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(zcGoods::className(), ['id' => 'goods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute()
    {
        return $this->hasOne(zcAttribute::className(), ['id' => 'attribute_id']);
    }
}
