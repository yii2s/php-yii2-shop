<?php
//update `zc_exend` a, zc_exprice b set a.price=b.price,a.priceTotal=b.priceTotal,a.gongyingshang=b.gongyingshang WHERE a.pinming = b.gongyingshangxinghao
header("Content-Type:text/html;charset=utf-8");

header("Content-type: text/html; charset=utf-8");
require("./common/components/sphinxapi.php");
$s = new SphinxClient;
$s->setServer("127.0.0.1", 9312);

//SPH_MATCH_ALL, 匹配所有查询词(默认模式); SPH_MATCH_ANY, 匹配查询词中的任意一个; SPH_MATCH_EXTENDED2, 支持特殊运算符查询
$s->setMatchMode(SPH_MATCH_ALL);
$s->setMaxQueryTime(30);                                     //设置最大搜索时间
$s->SetArrayResult(false);                                       //是否将Matches的key用ID代替
$s->SetSelect ( "*" );                                           //设置返回信息的内容,等同于SQL
$s->SetRankingMode(SPH_RANK_BM25);                               //设置评分模式，SPH_RANK_BM25可能使包含多个词的查询的结果质量下降。
//$s->SetSortMode(SPH_SORT_EXTENDED);                            //发现增加此参数会使结果不准确
//$s->SetSortMode(SPH_SORT_EXTENDED,"from_id asc,id desc");      //设置匹配项的排序模式, SPH_SORT_EXTENDED按一种类似SQL的方式将列组合起来，升序或降序排列。
//$weights = array ('company_name' => 20);
//$s->SetFieldWeights($weights);                                   //设置字段权重
$s->SetLimits ( 0, 30, 1000, 0 );                                //设置结果集偏移量  SetLimits (便宜量,匹配项数目,查询的结果集数默认1000,阀值达到后停止)
//$s->SetFilter ( $attribute, $values, $exclude=false );     //设置属性过滤
//$s->SetGroupBy ( $attribute, $func, $groupsort="@group desc" );    //设置分组的属性
$res = $s->query('@* "'.$_GET['keyword'].'"','goods','--single-0-query--'); #[宝马]关键字，[news]数据源source


//代码高亮
$tags = array();
$tags_name = array();
foreach($res['matches'] as $key=>$value){
    $tags[] = $value['attrs'];
    $company_name[] = $value['attrs']['name'];
}
$company_name = $s->BuildExcerpts ($company_name, 'goods', $_GET['keyword'], $opts=array() );     //执行高亮，这里索引名字千万不能用*
foreach($tags as $k=>$v)
{
    $tags[$k]['name'] = $company_name[$k];  //高亮后覆盖
}

// 高亮后覆盖
$i = 0;
foreach($res['matches'] as $key=>$value){
    $res['matches'][$key] = $tags[$i];
    $i++;
}

$err = $s->GetLastError();

echo '<pre>';
var_export($res);
var_export($err);
echo '</pre>';

