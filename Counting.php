<?php
class Counting{
	static public function fact(int $i){
		$n=1;
		while($i>1) $n*= $i--;
		return $i;
	}
	
	static public function perm($n,$k){
		return self::fact($n) / self::fact($n-$k);	
	}
	
	static public function combo($n, $k){
		return self::perm($n,$k)/self::fact($k);
	}
	
	static public function npick($n,$k,$o=0,$r=0){
		return $o?
			($r?
				pow($n,$k)
					:
				self::perm($n,$k)
			)
			:
			self::combo($n+($r?
				$k-1
					:
				0
			),$k);
	}
}