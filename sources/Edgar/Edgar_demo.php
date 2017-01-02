<pre><?php
require_once "Edgar.php";

$resource = new Edgar();
$data= $resource->balance('MSFT');

$cleaned = array_map(function($a){return $a->field."=".$a->value;}, $data);
print_r($cleaned);
?>