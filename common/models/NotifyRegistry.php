<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%notify_registry}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $user_id
 * @property string $email
 * @property string $mobile
 * @property string $register_time
 * @property string $notify_time
 * @property integer $notify_status
 *
 * @property zcGoods $goods
 */
class NotifyRegistry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%notify_registry}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'user_id', 'register_time'], 'required'],
            [['goods_id', 'user_id', 'notify_status'], 'integer'],
            [['register_time', 'notify_time'], 'safe'],
            [['email'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 20],
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
            'email' => 'Email',
            'mobile' => 'Mobile',
            'register_time' => 'Register Time',
            'notify_time' => 'Notify Time',
            'notify_status' => 'Notify Status',
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
