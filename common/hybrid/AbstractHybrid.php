<?php

namespace common\hybrid;


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
}