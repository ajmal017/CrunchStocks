<?php
die('OPEN THIS FILE BEFORE LOADING');
function requestAccess(){
	$path= "https://api.stocktwits.com/api/2/oauth/token";
	$params=[
		'client_id'=> '33dba5f046aecc3f',
		'client_secret'=> '428f61ef071cca656cefd4431aaee2c477ebc7e1',
		'code'=> 'ddf84a8fee68e70801fcff93d120b3e6d90bcad4',
		'grant_type'=> 'authorization_code',
		'redirect_uri'=> 'http://www.stocktwits.com'
	];
	
	//access_token: 462bde4a300f6e3e45d4fea005c40225e903c4fc
	curl_setopt_array($curl = curl_init(), [
		CURLOPT_SSL_VERIFYPEER => !0,
		CURLOPT_CAINFO => __DIR__."/cert.pem",
		CURLOPT_CONNECTTIMEOUT => 5,
		CURLOPT_HEADER => !1,
		CURLOPT_SSL_VERIFYHOST => 2,
		CURLOPT_TIMEOUT => 5,
		CURLOPT_ENCODING => 'gzip',
		CURLOPT_RETURNTRANSFER => !0,
		CURLOPT_POST=> !0,
		CURLOPT_POSTFIELDS=> http_build_query($params),
		CURLOPT_URL => $path
	]);
	return [curl_exec($curl), $curl];
}

$file=__DIR__."/cert.pem";
copy(__DIR__."/../_dev/CA_certs.pem", $file);

$spacer="\n\n";

$certs= explode($spacer, file_get_contents($file));
$n=count($certs);
while($n>1){
	$sides= array_chunk($certs, ceil($n/2));
	file_put_contents($file, implode($spacer, $sides[0]));
	
	$req= requestAccess();
	if($req[0]) $certs=$sides[0];
	elseif(curl_errno($req[1])==60) file_put_contents($file, implode($spacer, $certs=$sides[1]));
	else break;

	$n=count($certs);
}
echo $certs[0];