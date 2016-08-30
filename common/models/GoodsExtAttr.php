<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%goods_ext_attr}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property integer $uid
 * @property integer $gid
 * @property string $create_time
 * @property integer $status
 */
class GoodsExtAttr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods_ext_attr}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value', 'uid', 'gid'], 'required'],
            [['uid', 'gid', 'status'], 'integer'],
            [['create_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
            'uid' => 'Uid',
            'gid' => 'Gid',
            'create_time' => 'Create Time',
            'status' => 'Status',
        ];
    }
}
