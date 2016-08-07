<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_attr_val_map}}".
 *
 * @property string $id
 * @property string $aid
 * @property string $vid
 */
class AttrValMap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_attr_val_map}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aid', 'vid'], 'required'],
            [['aid', 'vid'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'aid' => 'Aid',
            'vid' => 'Vid',
        ];
    }
}
