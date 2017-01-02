<pre><?php
require_once "Morningstar.php";

$resource= new Morningstar;
echo $resource->historical();
echo $resource->ratios();
echo $resource->quote();
echo $resource->statement('is');
echo $resource->statement('cf');
echo $resource->statement('bs');