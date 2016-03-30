<?php
namespace backend\form;

use common\models\Brand;
use common\models\BrandRelation;
use Yii;
use yii\base\Model;

/**
 * addBrand form
 */
class AddBrandForm extends Model
{
    public $categoryIDs;
    public $logo;
    public $flag;
    public $title;
    public $intro;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryIDs', 'title'], 'required','message' => '{attribute}不能为空'],
            ['flag', 'boolean'],
            [['logo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif'],
            ['intro','safe']
        ];
    }


    public function attributeLabels()
    {
        return [
            'categoryIDs' => '所属类别',
            'title' => '名称',
        ];
    }

    /**
     * 图片上传
     * @return bool
     * @since 2016-03-13
     */
    public function upload()
    {
        if ($this->validate()) {
            $this->logo->saveAs('uploads/' . $this->logo->baseName . '.' . $this->logo->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 添加品牌
     * @return bool
     * @since 2016-03-13
     */
    public function addBrand() {
        if ($this->hasErrors()) {
           return false;
        }
        $brand = new Brand();
        $brand->flag = $this->flag;
        $brand->intro = $this->intro;
        $brand->title = $this->title;
        $brand->logo = iconv("GB2312", "UTF-8//IGNORE", $this->logo->name);
        $brand->save();
        if ($lastInsertID = $brand->id) {
            foreach ($this->categoryIDs as $c) {
                $value[] = [$lastInsertID,$c];
            }
            Yii::$app->db->createCommand()->batchInsert(BrandRelation::tableName(), ['brandID', 'categoryID'],$value)->execute();
            return true;
        }
        return false;
    }
}
