<?php
class Nasdaq{
	protected $curl;
	
	function __construct(){
		curl_setopt_array($this->curl = curl_init(), [
			CURLOPT_CONNECTTIMEOUT => 5,
			CURLOPT_HEADER => !1,
			CURLOPT_TIMEOUT => 5,
			CURLOPT_ENCODING => 'gzip',
			CURLOPT_RETURNTRANSFER => !0
		]);
	}

	//'q'=>'NASDAQ','y'=>'NYSE','m'=>'AMEX'
	public function exchange($exch){
		curl_setopt($this->curl, CURLOPT_URL, "http://www.nasdaq.com/screening/companies-by-industry.aspx?render=download&exchange=" . $exch);
		return curl_exec($this->curl);
	}
}