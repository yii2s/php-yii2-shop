<?php
namespace backend\form;

use common\models\Attribute;
use common\models\Brand;
use common\models\BrandRelation;
use common\models\CategoryAttr;
use Yii;
use yii\base\Model;

/**
 * addBrand form
 */
class AddAttributeForm extends Model
{
    public $categoryID;
    public $title;
    public $values;
    public $inputType;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoryID', 'title'], 'required','message' => '{attribute}不能为空'],
            ['inputType', 'boolean'],
            ['values','safe']
        ];
    }


    public function attributeLabels()
    {
        return [
            'categoryID' => '所属类别',
            'title' => '名称',
        ];
    }


    /**
     * 添加属性
     * @return bool
     * @throws \yii\db\Exception
     */
    public function addAttributes()
    {
        if ($this->hasErrors()) {
            return false;
        }
        $attribute = new Attribute();
        $attribute->title = $this->title;
        $attribute->inputType = $this->inputType;
        $attribute->categoryID = $this->categoryID;
        $attribute->save();
        if ($lastInsertID = $attribute->id) {
            if ($this->values) {
                $values = explode(',',rtrim(str_replace('，',',',$this->values),','));
                foreach ((array)$values as $v) {
                    $arr[] = [$v,$lastInsertID];
                }
                Yii::$app->db->createCommand()->batchInsert(CategoryAttr::tableName(), ['value', 'attrID'],$arr)->execute();
            }
            return true;
        }
        return false;
    }

}
