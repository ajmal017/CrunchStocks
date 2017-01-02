<?php
/*home.business.utah.edu/bebrpsp/URPL5010/Lectures/6_ChangeMeasures.pdf*/
class SeriesMeasure{
	public function mode($s){
		$m=array_count_values($s);
		return array_search(max($s));
	}
	
	public function mean($s){
		return array_sum($s)/count($s);
	}
	
	public function median($s){
		$l=count($s)/2;
		asort($s,1);
		$a=$s[$l];
		return is_int($l)?($a+$s[--$l])/2:$a;
	}
	
	public function change($s){
		return end($s)/reset($s)-1;
	}
	
	public function avgChange($s){
		$c=count($s)-1;
		$t=-$c;
		foreach($s as $n)$t+=next($s)/$n;
		return $t/$c;
	}
	
	public function slope($s){}
	
	public function intercept($s){}
	
	public function stdDev($s,$p=0){//population standard dev
		$n=count($s);
		$o=-pow(array_sum($s),2)/$n;
		$p||$n--;
		foreach($s as $x)$o+=pow($x,2);
		$o/=$n;
		return pow($o,.5);
	}
	
	public function avgRtChg($s){
		return pow(end($s)/reset($s),1/count($s))-1;
	}
	
	public function percentileVal($s,$p){
		$c=array_count_values($s);
		ksort($c);
		$m=$p*count($s)/100;
		$t=0;
		foreach($c as $n=>$f) if(($t+=$f)>$m) return $n;
	}
	
	public function percentileGet($s,$n){
		$c=0;foreach($s as $m)$m<$n&&$c++;return 100*$c/count($s);
	}

	public function Q3($s){	/*delete this*/
		$c=array_count_values($s);
			ksort($c);
		
		$l=count($s);
		$t=reset($c);
		$summ=[$t];
		
		$q=0;
		$i=0;
		
			print_r($c);
			echo "<br><br>";
		
		$t+=reset($c); echo $t."<br>";
		$t+=next($c); echo $t."<br>";
		$t+=next($c); echo $t."<br>";
		$t+=next($c); echo $t."<br>";
		$t+=next($c); echo $t."<br>";
		$t+=next($c); echo $t."<br>";
		$t+=next($c); echo $t."<br>";
		echo "<br><br>";
		while($q<=1){
			//echo "<br>".$m."<br>";
			$m=$q*$l;
			echo "m:".$m."|";
			//while($t<$m)$t+=next($c);
			$q+=0.25;
			echo key($c)."<br>";
			//$summ[]=key($c);
			//echo "<br>".$n."<br>";
		}
		
		print_r($summ);
	}
	public function fiveSumm($s){return [min($s),max($s)];}
}

$arr= [2,3,4,5,6]; echo SeriesMeasure::avgChange($arr)."<br>";


$arr2= array_fill(0,54,""); $arr2[0]=279000; $arr2[53]=955166;
	echo SeriesMeasure::avgRtChg($arr2)."<br>";
	
$arr3= [1,2,3,4,5];//in our example, we use n=6.5.  0,1,2,3,4,5,and 6 are all lower than 6.5, theres 7/10, so by definition 6.5 is 70th percentile.
//if we sort we get: [0,1,2,3,4,5,6,6.5,7,8,9],  with $arr3[7]=6.5, and we take 7/(count($s)-1) 
	echo SeriesMeasure::percentileGet($arr3,6.7)."<br>";
	
echo SeriesMeasure::percentileVal($arr3,90)."<br><br><br>";//were looking for approximately the 80th percentile value of this array;  We know there are 10 values, so 80th means that 80% of 10, or 8 values are lower than this number.  so we would say that those 8 numbers are 0-7, leaving 80th percentile at 8.

//calculated by taking the count of each value, 

echo SeriesMeasure::Q3($arr3)."<br>";
?>