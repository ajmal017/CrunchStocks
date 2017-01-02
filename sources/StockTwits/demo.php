<pre><?php
require_once 'StockTwits.php';

$source= new StockTwits;
$data= json_decode($source->trending());
print_r(array_map(function($a){return $a->title;}, $data->symbols));

$data= json_decode($source->suggested());
print_r(array_map(function($a){return $a->body;}, $data->messages));