<?php
class Request{
	private function filter($v,$p="/[^\w\s,-]/"){return htmlspecialchars(stripslashes(trim($p?preg_replace($p,'',$v):$v)));}
	public function csvArr($c,$u=0){$r=array_filter(array_map("self::filter",explode(",",$c)),function($v){return !empty($v);});return $u?array_values(array_unique($r)):$r;}
	public function cleanGet($k,$a=0){return empty($_GET[$k])?null:($a?(self::csvArr($_GET[$k])):(self::filter($_GET[$k])));}
	public function cleanPost($k,$a=0){return empty($_POST[$k])?null:($a?(self::csvArr($_POST[$k])):(self::filter($_POST[$k])));}
	public function log(){return function(){echo PHP_EOL.json_encode(func_get_args());ob_flush();flush();};}
	public function upload($d,$s){$L=self::log();foreach($_FILES as $F){foreach($F['error'] as $i=>$e){if($e===0&&$F['size'][$i]<$s){$b=basename($F['name'][$i]);$n="";while(file_exists($d.$n.$b))$n.=mt_rand(0,9);$L($b,move_uploaded_file($F['tmp_name'][$i],$d.$n.$b));}}}}
}
?>