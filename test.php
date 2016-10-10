<?php

require("sphinxapi.php");

$cl = new SphinxClient ();

$s_key = $_GET['keyword'] ?: 'two';
$cl->SetServer( 'localhost', 9312);
$cl->SetConnectTimeout ( 3 );
$cl->SetArrayResult ( true );
$cl->SetMatchMode ( SPH_MATCH_ANY);
$res = $cl->Query ( $s_key, "*" );

$data = [];
$data['total'] = $res['total_found'];
$data['time'] = $res['time'];
$data['keyword'] = $res['words'];

$result = $res['matches'];
foreach ($result as $r) {
    $temp = [];
    $temp['id'] = $r['id'];
    foreach ($r['attrs'] as $key => $attr) {
        $temp[$key] = $attr;
    }
    $data['data'][] = $temp;
}

echo '<pre>';
print_r($data);
echo '</pre>';

