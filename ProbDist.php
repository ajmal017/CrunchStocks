<?php
abstract class ProbDist{
	//abstract public function graph($x);
	abstract public function mean();
	abstract public function variance();
	abstract public function pdf($x);
	abstract public function cdf($a,$b);
	
	//THE RECURSIVE VERSIONS AS FALLBACKS, INCASE UNABLE TO DERIVE.  WILL LOOP THROUGH PDF LOOKING FOR ANSWERS, unless a cdf or invert shortcut formula function is derived then defined.
	
	public function cdf(){}
	public function invert(){}
	
	public demo($type='Binomial'){
		$drv= new Binomial(12, .4);
			echo "P(X=1)= ".$drv->pdf(1)."<br>";
			echo "Mean= ".$drv->mean()."<br>";
			echo "Variance= ".$drv->variance()."<br>";
	}
}

//BREAK EACH DISTRIBUTION INTO ITS OWN FILE WHEN ITS DEVELOPED

class Binomial extends ProbDist{
	public $p;
	public $n;
	
	function __construct($n,$p){
		$this->p=$p;
		$this->n=$n;
	}
	
	//public function graph($x){echo 44;}
	public function mean(){return $this->n - $this->p;}
	public function variance(){return pow($this->n*$this->p*(1-$this->p), 2);}
	public function pdf($x){
		return Stat::combo($this->n, $x) * pow($this->p, $x) * pow(1-$this->p, $this->n-$x);
	}
	public function cdf($a,$b){echo 44;}

}

$drv= new Binomial(12, .4);
	echo "P(X=1)= ".$drv->pdf(1)."<br>";
	echo "Mean= ".$drv->mean()."<br>";
	echo "Variance= ".$drv->variance()."<br>";
	
	
class Geometric extends ProbDist{
	public $p;
	
	function __construct($p){
		$this->p=$p;
	}
	
	//public function graph($x){echo 44;}
	
	
	public function mean(){
		return 1/$this->p;
	}
	
	public function variance(){
		return (1 - $this->p)/pow($this->p, 2);
	}
	
	//x is the number of trials before 1st success
	public function pdf($x){
		return $this->p * pow(1 - $this->p, $x - 1);
	}

	public function invert($p){
		return log($p/$this->p) / log(1-$this->p) + 1;
	}
	
	/*inclusive interval from a to b,
		P(x >= a) = cdf(a)
		P(x <= a) = cdf(-a)
		P(a <= x <= b) = cdf(a,b)
	*/
	public function cdf(int $a, int $b=null){
		$q=1-$this->p;
		$n=pow($q,$a);
		return $a<1?1-1/$n:$n/$q-($b>$a?pow($q,$b):0);

	}

}

$drv= new Geometric(.4);
	echo "P(X=3) = ".$drv->pdf(3)."<br>";
	echo "Invert:  If P=.144, x= ".$drv->invert(.144)."<br>";
	echo "Mean= ".$drv->mean()."<br>";
	echo "Variance= ".$drv->variance()."<br>";

echo "<br><br><br>";
	
class NegBinomial extends ProbDist{
	public $p;
	public $r;
	
	function __construct($p, $r){
		$this->p=$p;
		$this->r=$r;
	}
	
	//public function graph($x){echo 44;}
	public function mean(){
		return $this->r/$this->p;
	}
	public function variance(){
		return $this->r * (1-$this->p) / pow($this->p, 2);
	}
	public function pdf($x){
		return Stat::combo($x-1,$this->r - 1) * pow($this->p, $this->r) * pow(1-$this->p, $x - $this->r);
	}

	public function invert($p){
	}
	
	public function cdf($a,$b){}

}

$drv= new NegBinomial(.4, 3);
	echo "P(X=3) = ".$drv->pdf(6)."<br>";
	//echo "Invert:  If P=.144, x= ".$drv->invert(.144)."<br>";
	echo "Mean= ".$drv->mean()."<br>";
	echo "Variance= ".$drv->variance()."<br>";
	

echo "<br><br><br>";
	
class Hypergeometric extends ProbDist{
	public $n;
	public $r;
	public $k;
	
	function __construct($n, $r, $k){
		$this->n=$n;
		$this->r=$r;
		$this->k=$k;
	}
	
	//public function graph($x){echo 44;}
	public function mean(){
		return $this->k * $this->r / $this->n;
	}
	public function variance(){
		return $this->k * $this->r * ($this->n - $this->r) * ($this->n - $this->k) / (pow($this->n, 2) * ($this->n - 1));
	}
	public function pdf($x){
		return Stat::combo($this->r, $x) * Stat::combo($this->n - $this->r, $this->k - $x) / Stat::combo($this->n, $this->k);
	}

	public function invert($p){
	}
	
	public function cdf($a,$b){}

}

$drv= new Hypergeometric(10, 3, 4);
	echo "P(X=2) = ".$drv->pdf(2)."<br>";
	//echo "Invert:  If P=.144, x= ".$drv->invert(.144)."<br>";
	echo "Mean= ".$drv->mean()."<br>";
	echo "Variance= ".$drv->variance()."<br>";echo "<br><br><br>";
	
class Poisson extends ProbDist{
	public $l;
	
	function __construct($l){
		$this->l=$l;
	}
	
	public function mean(){
		return $this->l;
	}
	public function variance(){
		return $this->l;
	}
	public function pdf($x){
		return pow($this->l, $x) * exp(-$this->l) / Stat::fact($x);
	}

	public function invert($p){
	}
	
	public function cdf($a,$b){}

}

$drv= new Poisson(4);
	echo "P(X=2) = ".$drv->pdf(2)."<br>";
	//echo "Invert:  If P=.144, x= ".$drv->invert(.144)."<br>";
	echo "Mean= ".$drv->mean()."<br>";
	echo "Variance= ".$drv->variance()."<br>";
	
class Exponential extends ProbDist{}

class Normal extends ProbDist{}

class ChiSquare extends ProbDist{}

class Wilcoxon extends ProbDist{}

class Friedmann extends ProbDist{}

class Gamma extends ProbDist{}

class Beta extends ProbDist{}