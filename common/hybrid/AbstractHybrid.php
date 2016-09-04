<?php

namespace common\hybrid;



use common\models\Spec;
use Yii;

class AbstractHybrid
{
    /**
     * @brief 批量插入数据
     * Note：该方法支持在Yii::$app->db数据库
     *
     * @param string $tableName 表名
     * @param array $column 表字段
     * @param array $values 插入值
     * @return int
     * @throws \yii\db\Exception
     */
    public function batchSave($tableName, array $column, array $values)
    {
        return Yii::$app->db->createCommand()
            ->batchInsert($tableName, $column, $values)
            ->execute();
    }

    /**
     * @brief 单条数据保存或修改
     * @param string $className \common\models\Goods
     * Note: 类名如果没有带命名空间，默认是在\common\models下查询
     * @see _getClassName()
     *
     * @param array $data 需要保存的数据结构
     * <pre>
     *  [
     *      'id' => 1,
     *      'name' => 'wuzhc'
     * ]
     * </pre>
     * Note: 如果数据结构的键名称对应不上数据库的列名，将自动被
     * 过滤掉，@see _filterAttributes()
     *
     * @param array $find 查询条件
     * Note: 根据条件创建对象，如果没有对象，则新建一个对象
     * @see _createModel()
     *
     * @return int
     * @since 2016-08-31
     */
    public function save($className, $data = array(), $find = array())
    {
        $className = $this->_getClassName($className);
        $model = $this->_createModel($className, $find);
        $data = $this->_filterAttributes($data, $model);

        foreach ($data as $key => $value) {
            $model->$key = $value;
        }

        if (YII_DEBUG && $model->getErrors()) {
            print_r($model->getErrors());
            exit;
        }

        return $model->save() ? $model->id : 0;
    }

    /**
     * @brief 过滤非法字段
     * @param $data
     * @param $model
     * @return mixed
     */
    private function _filterAttributes($data, $model)
    {
        $illegalAttributes = array_diff(array_keys($data), array_keys($model->attributes));
        foreach ((array)$illegalAttributes as $k) {
            unset($data[$k]);
        }
        return $data;
    }

    /**
     * @brief 创建模型对象
     * @param string $className
     * @param array $find
     * @return object
     */
    private function _createModel($className, $find = array())
    {
        if ($find) {
            $model = $className::find()->where($find)->one();
        } else {
            $model = new $className();
        }
        return $model;
    }

    /**
     * @brief 类名
     * @param $className
     * @return string
     */
    private function _getClassName($className)
    {
        if (strpos($className, '\\') === false) {
            $className = '\\common\\models\\' . ucwords($className);
            //Yii::autoload($className);
        }
        return $className;
    }
}