<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wzc_brand}}".
 *
 * @property string $id
 * @property string $title
 * @property string $logo
 * @property string $intro
 * @property integer $flag
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wzc_brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['intro'], 'string'],
            [['flag', 'status'], 'integer'],
            [['title'], 'string', 'max' => 30],
            [['logo'], 'string', 'max' => 225],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'logo' => 'Logo',
            'intro' => 'Intro',
            'flag' => 'Flag',
            'status' => 'Status',
        ];
    }

    public function deleteBrand($id)
    {
        if (!$id) {
            return false;
        }
        $brand = self::findOne($id);
        if ($brand) {
           return $brand->delete();
        }
        return false;
    }

    /**
     * @param  string|array $ids
     * @return bool|int
     */
    public function batchDeleteBrand($ids)
    {
        if (!$ids) {
            return false;
        }
        if (is_array($ids)) {
            $ids = implode(',',$ids);
        }
        return self::deleteAll('id IN (:ids)',[':ids' => $ids]);
    }
}
