<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%exend}}".
 *
 * @property integer $id
 * @property string $band
 * @property string $category
 * @property string $pinhao
 * @property string $other
 * @property string $pinming
 * @property string $danwei
 * @property string $guige
 * @property string $gongyi
 * @property string $gongyingshang
 * @property string $pricetotal
 * @property string $price
 * @property string $chuchangjia
 * @property string $kucun
 * @property string $kucun79
 * @property string $kucun49
 * @property string $kucun19
 * @property string $fenlei
 * @property string $miaoshu
 */
class Exend extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%exend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['band', 'category', 'pinhao', 'other', 'gongyi', 'gongyingshang'], 'string', 'max' => 200],
            [['pinming'], 'string', 'max' => 300],
            [['danwei', 'guige', 'pricetotal', 'price', 'chuchangjia', 'kucun', 'kucun79', 'kucun49', 'kucun19', 'fenlei', 'miaoshu'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'band' => 'Band',
            'category' => 'Category',
            'pinhao' => 'Pinhao',
            'other' => 'Other',
            'pinming' => 'Pinming',
            'danwei' => 'Danwei',
            'guige' => 'Guige',
            'gongyi' => 'Gongyi',
            'gongyingshang' => 'Gongyingshang',
            'pricetotal' => 'Pricetotal',
            'price' => 'Price',
            'chuchangjia' => 'Chuchangjia',
            'kucun' => 'Kucun',
            'kucun79' => 'Kucun79',
            'kucun49' => 'Kucun49',
            'kucun19' => 'Kucun19',
            'fenlei' => 'Fenlei',
            'miaoshu' => 'Miaoshu',
        ];
    }
}
