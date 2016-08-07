<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_comment}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $order_no
 * @property string $user_id
 * @property string $time
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
        return '{{%zc_comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'order_no', 'user_id', 'time', 'comment_time', 'recomment_time'], 'required'],
            [['goods_id', 'user_id', 'point', 'status', 'seller_id'], 'integer'],
            [['time', 'comment_time', 'recomment_time'], 'safe'],
            [['contents', 'recontents'], 'string'],
            [['order_no'], 'string', 'max' => 20],
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
            'goods_id' => 'Goods ID',
            'order_no' => 'Order No',
            'user_id' => 'User ID',
            'time' => 'Time',
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
        return $this->hasOne(zcGoods::className(), ['id' => 'goods_id']);
    }
}
