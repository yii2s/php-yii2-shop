<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $order_no
 * @property string $member_id
 * @property string $buy_time
 * @property string $comment_time
 * @property string $contents
 * @property string $recontents
 * @property string $recomment_time
 * @property integer $point
 * @property integer $status
 * @property string $seller_id
 *
 * @property Goods $goods
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'order_no', 'member_id', 'buy_time', 'comment_time', 'recomment_time'], 'required'],
            [['goods_id', 'member_id', 'point', 'status', 'seller_id'], 'integer'],
            [['buy_time', 'comment_time', 'recomment_time'], 'safe'],
            [['contents', 'recontents'], 'string'],
            [['order_no'], 'string', 'max' => 20],
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
            'order_no' => 'Order No',
            'member_id' => 'User ID',
            'buy_time' => 'buy_time',
            'comment_time' => 'Comment Time',
            'contents' => 'Contents',
            'recontents' => 'Recontents',
            'recomment_time' => 'Recomment Time',
            'point' => 'Point',
            'status' => 'Status',
            'seller_id' => 'Seller ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }
}
