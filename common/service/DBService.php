<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2016/8/30
 * Time: 13:48
 */

namespace common\service;


use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;

class DBService extends AbstractService
{
    /**
     * Returns the static model.
     * @param string $className Service class name.
     * @return DBService the static model class
     */
    public static function factory($className=__CLASS__)
    {
        return parent::factory($className);
    }

    /**
     * @brief 获取数据库所有表
     * @return array
     * @since 2016-08-30
     */
    public function tables()
    {
        return Yii::$app->db->createCommand('SHOW TABLES')->queryAll();
    }

    /**
     * @brief 表结构详情
     * @param $table
     * @return array
     * @since 2016-08-30
     */
    public function descTable($table)
    {
        return Yii::$app->db->createCommand('DESC '. $table)->queryAll();
    }

    /**
     * @brief 表详情
     * @param $table
     * @return array|false
     */
    public function showTable($table)
    {
        $sql = sprintf("SHOW TABLE STATUS LIKE '%s'", $table);
        $sql = str_replace('`', '', Yii::$app->db->createCommand($sql)->getRawSql());
        return Yii::$app->db->createCommand($sql)->queryOne();
    }

    /**
     * @brief 获取表所有列
     * @param $table
     * @return array
     * @since 2016-08-30
     */
    public function getColumns($table)
    {
        $columns = Yii::$app->db->createCommand('SHOW COLUMNS FROM '. $table)->queryAll();
        return ArrayHelper::getColumn($columns, 'Field');
    }

    /**
     * @brief 获取mysql版本
     * @return string
     * @since 2016-08-30
     */
    public function getVersion()
    {
        $version = Yii::$app->db->createCommand('SELECT version() as version')->queryOne();
        return $version ? $version['version'] : '';
    }

    /**
     * @brief 增加表字段
     * e.g. DBService::factory()->addField(Task::tableName(), 'gaga', 'int(11) null default 0 after price');
     * @param $table
     * @param $column
     * @param $columnType
     * @throws \yii\db\Exception
     * @since 2016-08-20
     */
    public function addColumn($table, $column, $columnType)
    {
        if ($this->checkFieldExist($table, $column)) {
            return ;
        }

        $sql = sprintf('ALTER TABLE %s ADD COLUMN  %s %s', $table, $column, $columnType);
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * @brief 删除表字段
     * @param $table
     * @param $column
     * @throws \yii\db\Exception
     * @since 2016-08-20
     */
    public function dropColumn($table, $column)
    {
        if (!$this->checkFieldExist($table, $column)) {
            return ;
        }

        $sql = sprintf('ALTER TABLE %s DROP %s', $table, $column);
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * @brief 检测字段是否存在
     * @param $table
     * @param string|array $cols
     * @return bool
     * @since 2016-08-30
     */
    public function checkFieldExist($table, $cols)
    {
        $flag = true;
        $columns = $this->getColumns($table);

        if (is_array($cols))
        {
            foreach ($cols as $field) {
                if (!in_array($field, $columns)) {
                    $flag = false;
                    break;
                }
            }
        }
        elseif (is_string($cols))
        {
            if (!in_array($cols, $columns)) {
                $flag = false;
            }
        }

        return $flag;
    }

    /**
     * @brief 创建索引
     * @param $table
     * @param $name
     * @param $columns
     * @param bool|false $unique
     * @return string
     * @since 2016-08-30
     */
    public function createIndex($table, $name, $columns, $unique = false)
    {
        if ($this->checkFieldExist($table, $columns) === false) {
            return 'column is not exist';
        }

        try {
            Yii::$app->db->createCommand()->createIndex($name, $table, $columns, $unique)->execute();
        } catch (Exception $e) {
           YII_DEBUG && print_r($e->getMessage());
        }
    }

    /**
     * @brief 删除索引
     * @param $table
     * @param $name
     * @return string
     * @since 2016-08-30
     */
    public function dropIndex($table, $name)
    {
        try {
            Yii::$app->db->createCommand()->dropIndex($name, $table)->execute();
        } catch (Exception $e) {
            YII_DEBUG && print_r($e->getMessage());
        }
    }

    /**
     * @brief 优化表
     *
     * OPTIMIZE TABLE 用于回收闲置的数据库空间，当表上的数据行被删除时，
     * 所占据的磁盘空间并没有立即被回收，使用了OPTIMIZE TABLE命令后这些空间将被回收，
     * 并且对磁盘上的数据行进行重排（注意：是磁盘上，而非数据库）。
     *
     * 多数时间并不需要运行OPTIMIZE TABLE，只需在批量删除数据行之后，或定期
     * （每周一次或每月一次）进行一次数据表优化操作即可，只对那些特定的表运行。
     *
     * @param $table
     * @return string
     * @since 2016-08-30
     */
    public function optimizeTable($table)
    {
        try {
            Yii::$app->db->createCommand('OPTIMIZE TABLE ' . $table)->execute();
        } catch (Exception $e) {
            YII_DEBUG && print_r($e->getMessage());
        }
    }

    /**
     * @brief 用于修复被破坏的表
     * @param $table
     * @return string
     */
    public function repairTable($table)
    {
        try {
            Yii::$app->db->createCommand('REPAIR TABLE ' . $table)->execute();
        } catch (Exception $e) {
            YII_DEBUG && print_r($e->getMessage());
        }
    }

    /**
     * @brief 重新命名表名
     * @param string $old 旧表名
     * @param string $new 新表名
     * @return string
     * @since 2016-08-31
     */
    public function renameTable($old, $new)
    {
        try {
            Yii::$app->db->createCommand(sprintf('RENAME TABLE %s TO %s', $old, $new))->execute();
        } catch (Exception $e) {
            YII_DEBUG && print_r($e->getMessage());
        }
    }

}