<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_regiment}}".
 *
 * @property string $id
 * @property string $title
 * @property string $start_time
 * @property string $end_time
 * @property integer $store_nums
 * @property integer $sum_count
 * @property integer $limit_min_count
 * @property integer $limit_max_count
 * @property string $intro
 * @property integer $is_close
 * @property string $regiment_price
 * @property string $sell_price
 * @property string $goods_id
 * @property string $img
 * @property integer $sort
 * @property string $seller_id
 *
 * @property zcGoods $goods
 */
class Regiment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_regiment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'start_time', 'end_time', 'goods_id'], 'required'],
            [['start_time', 'end_time'], 'safe'],
            [['store_nums', 'sum_count', 'limit_min_count', 'limit_max_count', 'is_close', 'goods_id', 'sort', 'seller_id'], 'integer'],
            [['regiment_price', 'sell_price'], 'number'],
            [['title', 'intro', 'img'], 'string', 'max' => 255],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => zcGoods::className(), 'targetAttribute' => ['goods_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'store_nums' => 'Store Nums',
            'sum_count' => 'Sum Count',
            'limit_min_count' => 'Limit Min Count',
            'limit_max_count' => 'Limit Max Count',
            'intro' => 'Intro',
            'is_close' => 'Is Close',
            'regiment_price' => 'Regiment Price',
            'sell_price' => 'Sell Price',
            'goods_id' => 'Goods ID',
            'img' => 'Img',
            'sort' => 'Sort',
            'seller_id' => 'Seller ID',
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
