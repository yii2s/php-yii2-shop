<?php

$m = new MongoClient('mongodb://23.83.240.107:27017');    // 连接到mongodb


/*
$db = $m->test;            // 选择一个数据库
$collection = $db->runoob; // 选择集合
$document = array(
    "title" => "MongoDB",
    "description" => "database",
    "likes" => 100,
    "url" => "http://www.runoob.com/mongodb/",
    "by", "菜鸟教程"
);
$collection->insert($document);
echo "数据插入成功";*/


$db = $m->test;            // 选择一个数据库
$collection = $db->runoob; // 选择集合

$cursor = $collection->find();
// 迭代显示文档标题
echo '<pre>';
foreach ($cursor as $document) {
    var_dump($document);
    echo "\n";
}