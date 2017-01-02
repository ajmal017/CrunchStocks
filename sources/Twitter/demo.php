<pre><?php
require_once "../OAuth.php";
require_once "Twitter.php";

$resource = new Twitter();
$data = $resource->profile();
print_r(json_decode(utf8_encode($data)));

$data = $resource->tweets('AAPL', 5);
print_r(json_decode(utf8_encode($data)));
?>