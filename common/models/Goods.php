<?php

namespace common\models;

use common\behaviors\GoodsBehavior;
use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $id
 * @property string $name
 * @property string $goods_no
 * @property string $model_id
 * @property string $sell_price
 * @property string $market_price
 * @property string $cost_price
 * @property string $up_time
 * @property string $down_time
 * @property string $create_time
 * @property integer $store_nums
 * @property string $img
 * @property string $ad_img
 * @property integer $is_del
 * @property string $content
 * @property string $keywords
 * @property string $description
 * @property string $search_words
 * @property string $weight
 * @property integer $point
 * @property string $unit
 * @property integer $brand_id
 * @property integer $visit
 * @property integer $favorite
 * @property integer $sort
 * @property string $spec_array
 * @property integer $exp
 * @property integer $comments
 * @property integer $sale
 * @property integer $grade
 * @property string $seller_id
 * @property integer $is_share
 *
 * @property CommendGoods[] $CommendGoods
 * @property Comment[] $Comments
 * @property Discussion[] $Discussions
 * @property Favorite[] $Favorites
 * @property GoodsAttribute[] $GoodsAttributes
 * @property GoodsPhotoRelation[] $GoodsPhotoRelations
 * @property GroupPrice[] $GroupPrices
 * @property NotifyRegistry[] $NotifyRegistries
 * @property Products[] $Products
 * @property Refer[] $Refers
 * @property Regiment[] $Regiments
 * @property Relation[] $Relations
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @see GoodsBehavior::images
     * @method array 图片集
     */

    /**
     * @see GoodsBehavior::attrVals
     * @method array 属性值
     */

    /**
     * @see GoodsBehavior::comments
     * @method array 评论
     */

    public $images;
    public $attrVals;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'goods_no', 'model_id', 'sell_price', 'create_time'], 'required'],
            [['model_id', 'store_nums', 'is_del', 'point', 'brand_id', 'visit', 'favorite', 'sort', 'exp', 'comments', 'sale', 'grade', 'seller_id', 'is_share'], 'integer'],
            [['sell_price', 'market_price', 'cost_price', 'weight'], 'number'],
            [['up_time', 'down_time', 'create_time'], 'safe'],
            [['content', 'spec_array'], 'string'],
            [['name', 'search_words'], 'string', 'max' => 50],
            [['goods_no'], 'string', 'max' => 20],
            [['img', 'ad_img', 'keywords', 'description'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 10],
        ];
    }

    public function behaviors()
    {
        return [
            GoodsBehavior::className()
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
            'goods_no' => 'Goods No',
            'model_id' => 'Model ID',
            'sell_price' => 'Sell Price',
            'market_price' => 'Market Price',
            'cost_price' => 'Cost Price',
            'up_time' => 'Up Time',
            'down_time' => 'Down Time',
            'create_time' => 'Create Time',
            'store_nums' => 'Store Nums',
            'img' => 'Img',
            'ad_img' => 'Ad Img',
            'is_del' => 'Is Del',
            'content' => 'Content',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'search_words' => 'Search Words',
            'weight' => 'Weight',
            'point' => 'Point',
            'unit' => 'Unit',
            'brand_id' => 'Brand ID',
            'visit' => 'Visit',
            'favorite' => 'Favorite',
            'sort' => 'Sort',
            'spec_array' => 'Spec Array',
            'exp' => 'Exp',
            'comments' => 'Comments',
            'sale' => 'Sale',
            'grade' => 'Grade',
            'seller_id' => 'Seller ID',
            'is_share' => 'Is Share',
        ];
    }

    /**
     * @brief 推荐类商品
     * @return \yii\db\ActiveQuery
     */
    public function getCommendGoods()
    {
        return $this->hasMany(CommentGoods::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 商品评论
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 商品讨论表
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussions()
    {
        return $this->hasMany(Discussion::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 收藏夹表
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::className(), ['rid' => 'id']);
    }

    /**
     * @brief 属性值表
     * @return \yii\db\ActiveQuery
     */
    public function getGoodsAttributes()
    {
        return $this->hasMany(GoodsAttribute::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 相册商品关系表
     * @return \yii\db\ActiveQuery
     */
    public function getzcGoodsPhotoRelations()
    {
        return $this->hasMany(GoodsPhotoRelation::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 记录某件商品对于某组会员的价格关系表，优先权大于组设定的折扣率
     * @return \yii\db\ActiveQuery
     */
    public function getGroupPrices()
    {
        return $this->hasMany(GroupPrice::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 到货通知表
     * @return \yii\db\ActiveQuery
     */
    public function getNotifyRegistries()
    {
        return $this->hasMany(NotifyRegistry::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 货品表
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 咨询表
     * @return \yii\db\ActiveQuery
     */
    public function getRefers()
    {
        return $this->hasMany(Refer::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 团购
     * @return \yii\db\ActiveQuery
     */
    public function getRegiments()
    {
        return $this->hasMany(Regiment::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 文章商品关系表
     * @return \yii\db\ActiveQuery
     */
    public function getRelations()
    {
        return $this->hasMany(Relation::className(), ['goods_id' => 'id']);
    }

    /**
     * @brief 商品属性值
     * @return \yii\db\ActiveQuery
     */
    public function getAttrVal()
    {
        return $this->hasMany(GoodsAttrValMap::className(), ['gid' => 'id']);
    }

    /**
     * @brief 获取图集
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasMany(GoodsImage::className(), ['gid' => 'id']);
    }
}
