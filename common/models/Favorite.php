<?php

namespace common\models;

use backend\controllers\Member;
use Yii;

/**
 * This is the model class for table "{{%favorite}}".
 *
 * @property string $id
 * @property string $member_id
 * @property string $goods_id
 * @property string $create_time
 * @property string $summary
 * @property string $cat_id
 *
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%favorite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'goods_id', 'create_time', 'cat_id'], 'required'],
            [['member_id', 'goods_id', 'cat_id'], 'integer'],
            [['create_time'], 'safe'],
            [['summary'], 'string', 'max' => 255],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
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
            'member_id' => 'User ID',
            'goods_id' => 'goods_id',
            'create_time' => 'create_time',
            'summary' => 'Summary',
            'cat_id' => 'Cat ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR()
    {
        return $this->hasOne(Goods::className(), ['id' => 'goods_id']);
    }
}
