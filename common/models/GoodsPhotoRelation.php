<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_photo_relation}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $photo_id
 *
 * @property zcGoods $goods
 */
class GoodsPhotoRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_photo_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id'], 'required'],
            [['goods_id'], 'integer'],
            [['photo_id'], 'string', 'max' => 32],
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
            'photo_id' => 'Photo ID',
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
