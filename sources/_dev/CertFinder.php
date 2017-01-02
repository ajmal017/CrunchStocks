<pre><?php
$api= isset($_GET['api'])? basename($_GET['api']) : die; //  "TradeKing"
$method= isset($_GET['method'])? basename($_GET['method']) :die;  // "profile"
$args=isset($_GET['args'])? parse_str($_GET['args']) : [];

require_once '../OAuth.php';
require_once '../'.$api.'/class.php';

method_exists(new $api, $method) or die;

$file=__DIR__."/../".$api."/cert.pem";
copy(__DIR__."/CACERT.pem", $file);
$spacer="\n\n";

$certs= explode($spacer, file_get_contents($file));
$n=count($certs);
while($n>1){
	$source= new $api;
	$sides= array_chunk($certs, ceil($n/2));
	file_put_contents($file, implode($spacer, $sides[0]));

	if(call_user_func_array([$source,$method], $args)) $certs=$sides[0];
	elseif(curl_errno($source->curl)==60) file_put_contents($file, implode($spacer, $certs=$sides[1]));
	else break;

	$n=count($certs);
}
echo $certs[0];