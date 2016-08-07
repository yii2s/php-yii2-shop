<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_favorite}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $rid
 * @property string $time
 * @property string $summary
 * @property string $cat_id
 *
 * @property zcUser $user
 * @property zcGoods $r
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_favorite}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'rid', 'time', 'cat_id'], 'required'],
            [['user_id', 'rid', 'cat_id'], 'integer'],
            [['time'], 'safe'],
            [['summary'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => zcUser::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['rid'], 'exist', 'skipOnError' => true, 'targetClass' => zcGoods::className(), 'targetAttribute' => ['rid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'rid' => 'Rid',
            'time' => 'Time',
            'summary' => 'Summary',
            'cat_id' => 'Cat ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(zcUser::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getR()
    {
        return $this->hasOne(zcGoods::className(), ['id' => 'rid']);
    }
}
