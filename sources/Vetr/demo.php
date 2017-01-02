<pre><?php
require_once "Vetr.php";

$resource = new Vetr();
echo $resource->security('AAPL', 'NASDAQ')."<br>";

echo $resource->security('AAPL')."<br>";

echo $resource->rating('AAPL', 'NASDAQ', 'popular', 'active_only', 2, 15)."<br>";

echo $resource->posts('AAPL', 'NASDAQ', 'popular', true, 2, 15)."<br>";

echo $resource->stats('NASDAQ', 2, 150)."<br>";
?>