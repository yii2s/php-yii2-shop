<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $products_no
 * @property string $spec_array
 * @property integer $store_nums
 * @property string $market_price
 * @property string $sell_price
 * @property string $cost_price
 * @property string $weight
 *
 * @property zcGoods $goods
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'products_no'], 'required'],
            [['goods_id', 'store_nums'], 'integer'],
            [['spec_array'], 'string'],
            [['market_price', 'sell_price', 'cost_price', 'weight'], 'number'],
            [['products_no'], 'string', 'max' => 20],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => Goods::className(), 'targetAttribute' => ['goods_id' => 'id']],
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
            'products_no' => 'Products No',
            'spec_array' => 'Spec Array',
            'store_nums' => 'Store Nums',
            'market_price' => 'Market Price',
            'sell_price' => 'Sell Price',
            'cost_price' => 'Cost Price',
            'weight' => 'Weight',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(zcGoods::className(), ['id' => 'goods_id']);
    }
}
