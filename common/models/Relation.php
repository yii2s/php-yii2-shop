<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%zc_relation}}".
 *
 * @property string $id
 * @property string $goods_id
 * @property string $article_id
 *
 * @property zcGoods $goods
 * @property zcArticle $article
 */
class Relation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%zc_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id', 'article_id'], 'required'],
            [['goods_id', 'article_id'], 'integer'],
            [['goods_id'], 'exist', 'skipOnError' => true, 'targetClass' => zcGoods::className(), 'targetAttribute' => ['goods_id' => 'id']],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => zcArticle::className(), 'targetAttribute' => ['article_id' => 'id']],
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
            'article_id' => 'Article ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasOne(zcGoods::className(), ['id' => 'goods_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(zcArticle::className(), ['id' => 'article_id']);
    }
}
