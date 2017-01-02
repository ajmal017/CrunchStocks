<?php
//go here to initialize a fetching session.  load all parameters, limitations,..etc
//should encrypt the json config file and only open with password hand typed when admin is entering the "fetching room"
echo time();

$config= 'fetch.config';
clearstatcache();
$id= file_get_contents($config);

session_start();
if(date('Y-m-d', filemtime($config))===date('Y-m-d')) session_id($id);
else{
	session_regenerate_id();
	file_put_contents($config, session_id());
	$_SESSION['FETCH']=[
		'barchart'=>[
			'limit'=>2500,
			'reset'=>1482129841,
			'n'=>2499
		],
		'Twitter'=>1500,
		'Vetr'=>1500
	
	];
}
/*
$df= new DataFlow
$df->barchart('intraday',[]);
	if(!isset($_SESSION['FETCH'][__METHOD__])){
		$_SESSION['FETCH'][__METHOD__]=new Limit(2500 calls, 15 minutes);
	}
	new BarChart
*/