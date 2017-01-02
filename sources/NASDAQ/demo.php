<pre><?php
/*
require_once "Nasdaq.php";

$resource = new Nasdaq();
var_dump($resource->exchange('m'));
*/
$url="http://www.nasdaq.com/screening/companies-by-industry.aspx?render=download&exchange=m";
$dump= fopen("AMEX.csv",'w');

curl_setopt_array($curl = curl_init($url), [
	CURLOPT_CONNECTTIMEOUT => 10,
	CURLOPT_HEADER => !1,
	CURLOPT_TIMEOUT => 10,
	CURLOPT_ENCODING => 'gzip',
	CURLOPT_RETURNTRANSFER => !0,
	CURLOPT_FILE => $dump,
	CURLOPT_FOLLOWLOCATION => true
]);
curl_exec($curl);
var_dump(curl_error($curl));

//while($line = fgetcsv($file,1024)) { var_dump($line)."<br>"; }
