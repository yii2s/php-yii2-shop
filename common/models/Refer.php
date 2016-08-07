<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_refer}}".
 *
 * @property string $id
 * @property string $question
 * @property string $user_id
 * @property string $goods_id
 * @property string $answer
 * @property string $admin_id
 * @property string $seller_id
 * @property integer $status
 * @property string $time
 * @property string $reply_time
 *
 * @property zcGoods $goods
 */
class Refer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_refer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'goods_id'], 'required'],
            [['question', 'answer'], 'string'],
            [['user_id', 'goods_id', 'admin_id', 'seller_id', 'status'], 'integer'],
            [['time', 'reply_time'], 'safe'],
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
            'question' => 'Question',
            'user_id' => 'User ID',
            'goods_id' => 'Goods ID',
            'answer' => 'Answer',
            'admin_id' => 'Admin ID',
            'seller_id' => 'Seller ID',
            'status' => 'Status',
            'time' => 'Time',
            'reply_time' => 'Reply Time',
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
