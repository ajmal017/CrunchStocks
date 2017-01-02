<?php
class YahooFin{
	
	//fundamentals:  doesnt actually work yet but need to do something like this:
	//s: ['AAPL', 'YHOO']//decide beforehand a set of important variables that will be put into the database, doesnt really need a parameter, if were fetching data, we might as well gather it all for later use rather than just one cell at time
		
		
	//MAYBE IN DATASRC ABSTRACT CLASS, DEFINE METHODS FOR DAILY, WEEKLY, MONTHLY... SO SYSTEM KNOWS WHEN TO PULL DATA.
	public static $vars=[
		's'=>'Symbol',
		'x'=>'Stock Exchange',

		//INTRADAY
		'a'=>'Ask',
		'a5'=>'Ask Size',
		'b'=>'Bid',
		'b6'=>'Bid Size',
		'k3'=>'Last Trade Size',
		'l1'=>'Last Price',
		's7'=>'Short Ratio',
		'v'=>'Volume',

	
		
		//DAILY
		'r6'=>'Price/EPS Estimate Current Year',
		'r7'=>'Price/EPS Estimate Next Year',
		'e7'=>'EPS Estimate Current Year',
		'e8'=>'EPS Estimate Next Year',
		'e9'=>'EPS Estimate Next Quarter',
		't8'=>'1 yr Target Price',
		'j1'=>'Market Capitalization',
		
		//QUARYERLY
			'b4'=>'Book Value',
			'e'=>'Earnings/Share',
			'j4'=>'EBITDA',
			'p5'=>'Price/Sales',
			'p6'=>'Price/Book',
			'r'=>'P/E Ratio',
			'r5'=>'PEG Ratio',
			's6'=>'Revenue',
			'f6'=>'Float Shares',
		
			//DIVIDEND
			'q'=>'Ex-Dividend Date',
			'd'=>'Dividend/Share',
			'r1'=>'Dividend Pay Date',
			'y'=>'Dividend Yield'
	];
	
	
	private static function quotes(array $s=null, string $f){
		return fopen("http://finance.yahoo.com/d/quotes.csv?s=" . implode("+", $s) . "&f=sx" . $f, "r");
	}
	
	public static function getAll(){
		$s=['YHOO','GOOG','TD'];
		$f=fopen("http://finance.yahoo.com/d/quotes.csv?s=" . implode("+", $s) . "&f=" . implode("", array_keys(self::$vars)), "r");
		while($v=fgetcsv($f)){
			echo "<h1>".array_shift($s).":</h1>";
			echo "<table><tbody>";
			echo "<th>Key</th><th>Variable</th><th>Value</th>";
			foreach(self::$vars as $k=>$n) echo "<tr><td>".$k."</td><td>".$n."</td><td>".array_shift($v)."</td></tr>";
			echo "</tbody></table>";
		}
	
	}

	public static function intraday($s){
		$f=self::quotes($s,"aa5bb6k3l1s7v");
		while($r=fgetcsv($f)){
			echo "<pre>";
			$r=array_combine(['Name','Exchange','Ask','AskSize','Bid','BidSize','LastSize','LastPrice','ShortRatio','Volume'],$r);
			print_r($r);
		
		}
	
	
	}
	
	public static function future($s){
		$f=self::quotes($s,"r6r7e7e8e9t8");
		while($r=fgetcsv($f)){
			echo "<pre>";
			$r=array_combine(['Name','Exchange','Price/EPS Est. Now','Price/EPS Est. Future','EPS Est. Now','EPS Est. Future','EPS Est. Quarter','Target Price 1Y'],$r);
			print_r($r);
		
		}
		
		
	
	}
	
	public static function book(array $s){
		/*
		'b4'=>'Book Value',
		'e'=>'Earnings/Share',
		'j1'=>'Market Capitalization',
		'j4'=>'EBITDA',
		'p5'=>'Price/Sales',
		'p6'=>'Price/Book',
		'r'=>'P/E Ratio',
		'r5'=>'PEG Ratio',
		's6'=>'Revenue',
		'f6'=>'Float Shares',
		*/
		
		$file=fopen("http://finance.yahoo.com/d/quotes.csv?s=" . implode("+", $s) . "&f=" . implode("", array_keys(self::$vars)), "r");
		
		while($row= fgetcsv($file)){
			//$unit=substr($r[1],-1);
			//$c=floatval(substr($r[1],0,-1));
			//if($u=='M')$c/=1000;elseif($u=='K')$c/=1000000;
			//$O[$r[0]]=$c;
			print_r($row);
			echo "<br>";
		}
		//return $O;
	}
}