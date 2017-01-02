<?php
//namespace DataSource;
class GoogleFin{
	protected $curl;
	protected $api= "https://www.google.com/finance/";
	
	function __construct(){
		curl_setopt_array($this->curl = curl_init(), [
			
		]);
	}
	
	private function fetch($path, $params=[]){
		curl_setopt($this->curl, CURLOPT_URL, $this->api . $path . '?' . http_build_query(array_filter($params)));
		return curl_exec($this->curl);
	}
	
	private function ticker($tick, $exch=''){return (empty($exch)?'':$exch.':').$tick;}
	
	
	public function intraday($tick, $exch='', $fields='d,o,h,l,c,v', int $seconds=60, $period='', $start=''){
		return $this->fetch('getprices', [
			'q' => $tick,
			'x' => $exch,
			'i' => $seconds,
			'p' => $period,
			'f' => $fields,
			'ts' => $start
		]);
    }
	
	public function news($tick, $exch='', int $n=0, int $i=0, $start='', $end='', $output='json'){//LIMIT? N=?
		return $this->fetch('company_news', [
			'q' => $this->ticker($tick, $exch),
			'num' => $n,
			'start' => $i,
			'startdate' => $start,
			'enddate' => $end,
			'output' => $output
		]);
    }
}