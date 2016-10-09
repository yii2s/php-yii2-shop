<?php

require("sphinxapi.php");

$cl = new SphinxClient ();

$s_key = $_GET['keyword'] ?: 'two';
$cl->SetServer( 'localhost', 9312);
$cl->SetConnectTimeout ( 3 );
$cl->SetArrayResult ( true );
$cl->SetMatchMode ( SPH_MATCH_ANY);
$res = $cl->Query ( $s_key, "*" );

echo '<pre>';
print_r($res);
echo '</pre>';
echo '<hr>';
echo '<pre>';
print_r($cl);
echo '</pre>';
