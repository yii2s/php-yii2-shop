<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%group_price}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $product_id
 * @property string $group_id
 * @property string $price
 *
 * @property zcGoods $goods
 * @property zcUserGroup $group
 */
class GroupPrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group_price}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'group_id'], 'required'],
            [['goods_id', 'product_id', 'group_id'], 'integer'],
            [['price'], 'number'],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => zcGoods::className(), 'targetAttribute' => ['goods_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => zcUserGroup::className(), 'targetAttribute' => ['group_id' => 'id']],
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
            'product_id' => 'Product ID',
            'group_id' => 'Group ID',
            'price' => 'Price',
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
    public function getGroup()
    {
        return $this->hasOne(zcUserGroup::className(), ['id' => 'group_id']);
    }
}
