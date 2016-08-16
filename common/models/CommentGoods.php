<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%commend_goods}}".
 *
 * @property string $id
 * @property string $commend_id
 * @property string $goods_id
 *
 * @property Goods $goods
 */
class CommentGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%commend_goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commend_id', 'goods_id'], 'required'],
            [['commend_id', 'goods_id'], 'integer'],
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
            'commend_id' => 'Commend ID',
            'goods_id' => 'Goods ID',
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
