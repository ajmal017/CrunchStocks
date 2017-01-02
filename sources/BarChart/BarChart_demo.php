<pre><?php
require_once "BarChart.php";

$resource = new BarChart();
$data = $resource->intraday('AAPL, MSFT');
print_r($data);
?>