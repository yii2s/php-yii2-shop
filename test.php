<?php
header("Content-Type:text/html;charset=utf-8");

require("sphinxapi.php");

$cl = new SphinxClient ();

$s_key = $_GET['keyword'] ?: '双瓶装';
$cl->SetServer( 'localhost', 9312);
$cl->SetConnectTimeout ( 3 );
$cl->SetArrayResult ( true );
$cl->SetMatchMode ( SPH_MATCH_ANY);
//$cl->SetLimits(0, 2, 1); //第三个参数默认是1000，会影响到返回的结果数，如果需要返回更多的数据，需要设置第三个参数（该值不能大于max_matches）
$res = $cl->Query ( $s_key, "*" );
if (false === $res) {
    echo 'query fail' . $cl->GetLastError();
    exit;
} elseif ($cl->GetLastWarning()) {
    echo 'warning' . $cl->GetLastWarning();
}


$data = [];
$data['total'] = $res['found']; //total_found是匹配数，found是返回的结果数，这个结果数受到max_matches限制
$data['time'] = $res['time'];
$data['keyword'] = $res['words'];

$result = $res['matches'];
if ($result) {
    foreach ($result as $r) {
        $temp = [];
        $temp['id'] = $r['id'];
        foreach ($r['attrs'] as $key => $attr) {
            $temp[$key] = $attr;
        }
        $data['data'][] = $temp;
    }
}


echo '<pre>';
print_r($data);



