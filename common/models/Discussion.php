<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%discussion}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $user_id
 * @property string $time
 * @property string $contents
 * @property integer $is_check
 *
 * @property zcGoods $goods
 */
class Discussion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%discussion}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'user_id', 'time'], 'required'],
            [['goods_id', 'user_id', 'is_check'], 'integer'],
            [['time'], 'safe'],
            [['contents'], 'string'],
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
            'user_id' => 'User ID',
            'time' => 'Time',
            'contents' => 'Contents',
            'is_check' => 'Is Check',
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
