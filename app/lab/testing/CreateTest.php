<?php
/*
print_r($_GET);
    [cat] => v
    [vari] => mc
    [pool] => all
    [n-size] => 35
    [startDt] => 2016-02-07
    [endDt] => 2016-03-08
    [per-desc] => 
    [test-title] =>
*/
require_once "../../HttpParams.php";
foreach(['cat','vari','pool','nsize','startDt','endDt','perdesc','testtitle'] as $f)$$f=HttpParams::cleanGet($f);
//echo $nsize;
$Varis=['mc'=>'Market Cap'];
if(isset($Varis[$vari])) echo $Varis[$vari];
//pool selection
//if(isset($Varis[$vari])) echo $Varis[$vari];
echo $startDt;
?>