<?php
class Vetr{
	protected $curl;
	protected $api= "https://vetr-prod.apigee.net/v1/api/";
	protected $key= "&apikey={API-KEY}";
	
	function __construct(){
		$this->curl = curl_init();
	}

	private function fetch($path, $params=[]){
		$url= $this->api . $path . '?' . http_build_query(array_filter($params)) . $this->key;
		//CURL IT
		return $url;
	}
	
	private function ticker($tick, $exch=''){return (empty($exch)?'':$exch.':').$tick;}
	
	public function security($tick, $exch=''){
		return $this->fetch('research/securityInfo', [
			'ticker' => $this->ticker($tick, $exch)
		]);
    }
	
	public function rating($tick, $exch='', $sort='', $filter='', int $start=0, int $limit=0){
		return $this->fetch('posts/ticker', [
			'ticker' => $this->ticker($tick, $exch),
			'sortBy' => $sort,
			'ratingsFilter' => $filter,
			'start' => $start,
			'limit' => $limit
		]);
    }
	
	public function posts($tick, $exch='', $sort='', bool $full=false, int $start=0, int $limit=0){
		return $this->fetch('posts/ticker', [
			'ticker' => $this->ticker($tick, $exch),
			'sortBy' => $sort,
			'fullText' => $full,
			'start' => $start,
			'limit' => $limit
		]);
    }
	
	public function stats($exch, int $start=0, int $limit=0){
		return $this->fetch('research/getaggregateratings', [
			'exchange' => $exch,
			'start' => $start,
			'limit' => $limit
		]);
    }
}