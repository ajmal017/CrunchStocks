<pre><?php
require_once "../OAuth.php";
require_once "TradeKing.php";

$resource = new TradeKing();
$data = $resource->headlines(['MSFT']);
	print_r($data);
$data= $resource->toplists('gainers', 'Q');
	print_r(array_map(function($a){return $a->name;}, $data));
?>