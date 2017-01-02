<?php
/*home.business.utah.edu/bebrpsp/URPL5010/Lectures/6_ChangeMeasures.pdf*/
class SeriesModify{
//why is this called modify again?  i don't understand this anymore

	public function change($s){
		return end($s)/reset($s)-1;
	}
	
	public function avgChange($s){
		$c=count($s)-1;
		$t=-$c;
		foreach($s as $n) $t+=next($s)/$n;
		return $t/$c;
	}
	
	public function linReg($s){}
	
	public function avgRtChg($s){
		return pow(end($s)/reset($s),1/count($s))-1;
	}
}
/*
$arr= [2,3,4,5,6];
	echo SeriesMeasure::avgChange($arr)."<br>";


$arr2= array_fill(0,54,"");
	$arr2[0]=279000;
	$arr2[53]=955166;
	echo SeriesMeasure::avgRtChg($arr2);
*/