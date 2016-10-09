<?php

require("sphinxapi.php");

$cl = new SphinxClient ();

$cl->SetServer ( 'localhost', 9312);
$cl->SetConnectTimeout ( 3 );
$cl->SetArrayResult ( true );
$cl->SetMatchMode ( SPH_MATCH_ANY);
$res = $cl->Query ( $s_key, "two" );

echo '<pre>';
print_r($res);
echo '</pre>';
echo '<hr>';
echo '<pre>';
print_r($cl);
echo '</pre>';
