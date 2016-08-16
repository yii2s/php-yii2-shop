<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_image}}".
 *
 * @property string $id
 * @property string $gid
 * @property string $img
 */
class GoodsImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid'], 'required'],
            [['gid'], 'integer'],
            [['img'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gid' => 'Gid',
            'img' => 'Img',
        ];
    }
}
