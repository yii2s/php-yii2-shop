<?php
/**
 * Created by PhpStorm.
 * User: wuzhc
 * Date: 2016/9/13
 * Time: 8:39
 */

namespace common\components;


use Yii;
use yii\base\Component;

/**
 * Class CMongo
 * @package common\components
 */
class CMongo extends Component
{
    public $mongo;
    public $db;

    public $mongoDB = MONGO_DB;
    public $mongoPort = MONGO_PORT;
    public $mongoHost = MONGO_HOST;

    /**
     * Initializes CMongo.
     */
    public function init()
    {
        parent::init();

        try {
            $this->mongo = new \MongoClient(sprintf('mongodb://%s:%s', $this->mongoHost, $this->mongoPort));
        } catch (\MongoConnectionException $e) {
            echo $e->getMessage(); exit;
        }

        $this->selectMongoDB($this->mongoDB);
    }

    /**
     * @brief 显示数据库
     * @return array
     */
    public function listDBs()
    {
        $result = [];

        $dbs = $this->mongo->listDBs();
        foreach ((array)$dbs['databases'] as $db) {
            $result[] = $db;
        }

        return $result;
    }

    /**
     * @brief 返回连接信息
     * @return array
     */
    public function getConnections()
    {
        return $this->mongo->getConnections();
    }

    /**
     * @brief 删除数据库
     * @param string $db
     * @return bool
     */
    public function dropDB($db = '')
    {
        $db and $this->selectMongoDB($db);
        $result = $this->db->drop();
        return $result['ok'] == 1 ? true : false;
    }
    
    /**
     * @brief mongo版本
     * @return string
     */
    public function getVersion() 
    {
        return \MongoClient::VERSION;
    }

    /**
     * @brief 选择mongo数据库
     * @param $db
     * @since 2016-09-13
     */
    public function selectMongoDB($db)
    {
        $db or $db = MONGO_DB;
        $this->db = $this->mongo->selectDB($db);
    }

    /**
     * @brief 创建集合
     * @param $name
     * @return bool
     * @throws \yii\base\ExitException
     */
    public function createCollection($name)
    {
        try {
            $this->db->createCollection($name);
            return true;
        } catch (\MongoException $e) {
            echo $e->getMessage(); exit;
        }

    }

    //如果没有集合，插入数据会怎么样
    /**
     * @brief 插入数据
     * @param $name
     * @param $document
     * @return bool
     * @since 2016-09-13
     */
    public function insert($name, $document)
    {
        try {
            $this->db->$name->insert($document);
            return true;
        } catch (\MongoException $e) {
            echo $e->getMessage(); exit;
        }
    }

    /**
     * @brief 删除文档
     * @param $name
     * @param $condition
     * @param array $option 选项 e.g.
     * justOne : （可选）如果设为 true 或 1，则只删除一个文档。
     * writeConcern :（可选）抛出异常的级别。
     * @return bool
     */
    public function remove($name, $condition = array(), $option = array())
    {
        try {
            $this->db->$name->remove($condition, $option);
            return true;
        } catch (\MongoException $e) {
            echo $e->getMessage(); exit;
        }
    }

    /**
     * @brief 查询单挑数据
     * @param string $name 集合名称
     * @param array $condition
     * @param array $field 需要返回的字段
     * @return array|bool|null
     */
    public function findOne($name, $condition = array(), $field = array())
    {
        try {
            return $this->db->$name->findOne($condition, $field);
        } catch (\MongoException $e) {
            echo $e->getMessage(); exit;
        }
    }

    /**
     * @brief 查询集合文档
     * @param string $name 集合名称
     * @param array $condition e.g.
     *
     *      ['id' => ['$gt' => 1, '$lt' => 2]], //范围查询
     *      ['id' => ['$where' => 'function(){return this.id == 1}']],
     *      ['id' => ['$in' => [1,2,3]]],
     *      ['id' => ['$ne' => 1]], //不等于
     *      ['id' => ['$gte' => 1]], //不等于
     *      ['$or' => [['id' => 1], ['id' => 2]],
     *      ['$and' => [['id' => 1], ['id' => 2]],
     *
     * @return array
     */
    public function find($name, $condition = array())
    {
        try {
            return iterator_to_array($this->db->$name->find($condition));
        } catch (\MongoException $e) {
            echo $e->getMessage(); exit;
        }
    }

    /**
     * @param $name
     * @param array $newData
     *      ['$inc' => ['num' => 1]],           //自增加一
     *      ['$set' => ['name' => 'wuzhc']],    //更新指定字段，如果没有这个，整个文档将被替换
     *      ['name' => 'wuzhc']
     *
     * @param array $condition 查询条件
     * @param array $options 选项 e.g.
     *
     * upsert : 可选，这个参数的意思是，如果不存在update的记录，是否插入objNew,true为插入，默认是false，不插入。
     * multi : 可选，mongodb 默认是false,只更新找到的第一条记录，如果这个参数为true,就把按条件查出来多条记录全部更新。
     * writeConcern :可选，抛出异常的级别。
     */
    public function update($name, $newData = array(), $condition = array(), $options = array())
    {
        try {
            return $this->db->$name->update($condition, $newData, $options);
        } catch (\MongoException $e) {
            echo $e->getMessage(); exit;
        }
    }
}