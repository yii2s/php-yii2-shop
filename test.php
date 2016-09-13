<?php
header("Content-Type:text/html;charset=gbk");
include ('common\config\main.php');
include ('common\components\CMongo.php');
use common\components\CMongo;

//mongodb是安装在本机，使用的端口是27017。
//$client = new MongoClient("mongodb://127.0.0.1:27017");

//选择数据库并指定数据表.
//$collection = $client->test->persons;

//$collection = $client->shop->goods;

//插入数据
/*$array = array(
    'name'=>'liuruiqun',
    'age'=>25,
    'address'=>array(
        'province'=>'sichuang',
        'city'=>'chengdu'
    )
);
$ret = $collection->insert($array);*/

//插入数据
//$collection->insert(array('name' => 'hehe'));

//更新数据
//$collection->update(array('name'=>'liuruiqun'), array('name' => 'wuzhc'));

//查询数据
//$res = $collection->findOne();


//打印数据
//var_dump($res);

//CMongodb::instance()->insert('goods', array('name' => '嘎嘎'));
//$data = CMongodb::instance()->findOne('goods', array('id' => '8837'));
//$data = CMongodb::instance()->listDBs();
header("Content-Type:text/html;charset=utf-8");
//CMongodb::instance()->selectMongoDB('MONGO_DB');
$data = CMongo::db()->update('goods', ['$inc' => ['commentNum' => 2]], ['id' => 8837]);
//$data = CMongo::db()->findOne('goods', array('id' => array('$lt' => 8838)));
//var_dump($data);

//CMongo::db()->dropDB();

$dbs = CMongo::db()->listDBs();
var_dump($dbs);

