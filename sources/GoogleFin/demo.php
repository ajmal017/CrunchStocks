<pre><?php
require_once "GoogleFin.php";

$resource = new GoogleFin();
echo $resource->intraday('AAPL', 'NASDAQ')."<br>";

echo $resource->news('AAPL')."<br>";
?>