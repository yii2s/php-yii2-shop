<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%exprice}}".
 *
 * @property integer $id
 * @property string $gongyingshang
 * @property string $xinpinghao
 * @property string $jiupinghao
 * @property string $gongyingshangxinghao
 * @property string $guige
 * @property string $danwei
 * @property string $num
 * @property string $price
 * @property string $priceTotal
 * @property string $daohuoriqi
 * @property string $beizhu
 */
class Exprice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%exprice}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['beizhu'], 'string'],
            [['gongyingshang'], 'string', 'max' => 300],
            [['xinpinghao', 'jiupinghao', 'gongyingshangxinghao'], 'string', 'max' => 200],
            [['guige', 'danwei', 'num', 'price', 'priceTotal', 'daohuoriqi'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gongyingshang' => 'Gongyingshang',
            'xinpinghao' => 'Xinpinghao',
            'jiupinghao' => 'Jiupinghao',
            'gongyingshangxinghao' => 'Gongyingshangxinghao',
            'guige' => 'Guige',
            'danwei' => 'Danwei',
            'num' => 'Num',
            'price' => 'Price',
            'priceTotal' => 'Price Total',
            'daohuoriqi' => 'Daohuoriqi',
            'beizhu' => 'Beizhu',
        ];
    }
}
